<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use App\Models\Maintenance;
use App\Models\MaintenanceType;
use App\Models\Report;
use App\Notifications\CreatedMaintenanceNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MaintenanceRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Services\NotificationService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UpdatedMaintenanceNotification;
use App\Notifications\DeletedMaintenanceNotification;
use App\Services\ActivityService;
use Yajra\DataTables\Facades\DataTables;

class MaintenanceController extends Controller
{
    use AuthorizesRequests;

    protected $notificationService;
    protected $activityService;

    public function __construct(NotificationService $notificationService, ActivityService $activityService)
    {
        $this->notificationService = $notificationService;
        $this->activityService = $activityService;
    }
    public function index(Request $request)
    {
        $this->authorize('viewAny', Maintenance::class);

        $maintenancesQuery = $this->activityService->getActivitiesQuery($request, Maintenance::class);

        if ($request->ajax()) {
            return DataTables::of($maintenancesQuery)
                ->addColumn('computer_name', function ($maintenance) {
                    return $maintenance->computer->name;
                })
                ->addColumn('maintenance_type_name', function ($maintenance) {
                    return $maintenance->maintenanceType->name;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('maintenances.show', $row->id) . '" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-eye"></i> Mostrar</a>';
                    $btn .= ' <a href="' . route('maintenances.edit', $row->id) . '" class="btn btn-sm btn-success"><i class="fa fa-fw fa-edit"></i> Editar</a>';
                    $btn .= ' <form action="' . route('maintenances.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Estas seguro que deseas eliminar?\')"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                              </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('maintenance.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Maintenance::class);
        $maintenance = new Maintenance();
        $maintenanceTypes = MaintenanceType::all();
        $computers = $this->getComputers($request);

        return view('maintenance.create', compact('maintenance', 'maintenanceTypes', 'computers'));
    }

    private function getComputers(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('admin')) {
            return Computer::all();
        } elseif ($user->hasRole('employee')) {
            return Computer::whereHas('client', function ($query) use ($user) {
                $query->where('created_by', $user->id);
            })->get();
        } else {
            return collect(); // Empty collection for other roles
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaintenanceRequest $request): RedirectResponse
    {
        $this->authorize('create', Maintenance::class);
        $computer = Computer::find($request->computer_id);

        $clientName = $computer->client->user->name;
        $randomNumber = rand(100, 999);
        $timestamp = now()->format('Ymd');

        $maintenanceCode = $this->abbreviateName($clientName) . $randomNumber . $timestamp;

        $maintenance = Maintenance::create($request->validated() +
            [
                'code' => $maintenanceCode,
                'user_id' => auth()->id(),
                'computer_id' => $request->computer_id
            ]);

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployeesAndClients(new CreatedMaintenanceNotification($maintenance, Auth::user()));

        Report::create([
            'code' => $maintenanceCode,
            'description' => 'Initial maintenance report',
            'client_id' => $computer->client->id,
            'maintenance_id' => $maintenance->id,
        ]);

        return Redirect::route('maintenances.index')
            ->with('success', 'Maintenance created successfully.');
    }

    private function abbreviateName($name)
    {
        $words = explode(' ', $name);
        $abbreviation = '';

        foreach ($words as $word) {
            $abbreviation .= strtoupper(substr($word, 0, 1));
        }

        return $abbreviation;
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $maintenance = Maintenance::find($id);
        $this->authorize('view', $maintenance);

        return view('maintenance.show', compact('maintenance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request): View
    {
        $maintenance = Maintenance::find($id);
        $this->authorize('update', $maintenance);
        $computers = $this->getComputers($request);
        $maintenanceTypes = MaintenanceType::all();

        return view('maintenance.edit', compact('maintenance', 'computers', 'maintenanceTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MaintenanceRequest $request, Maintenance $maintenance): RedirectResponse
    {
        $this->authorize('update', $maintenance);

        $maintenance->update($request->validated());

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployeesAndClients(new UpdatedMaintenanceNotification($maintenance, Auth::user()));

        // Encontrar el reporte asociado al mantenimiento y actualizar la descripción
        $report = Report::where('maintenance_id', $maintenance->id)->first();
        if ($report) {
            $newDescription = $report->description . "\n" . now()->toDateTimeString() . ': Updated maintenance report';
            $report->update([
                'description' => $newDescription,
            ]);
        }

        return Redirect::route('maintenances.index')
            ->with('success', 'Maintenance updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $maintenance = Maintenance::find($id);

        $this->authorize('delete', $maintenance);

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployeesAndClients(new DeletedMaintenanceNotification($maintenance, Auth::user()));

        // Obtener el reporte asociado al mantenimiento
        $report = Report::where('maintenance_id', $maintenance->id)->first();

        if ($report) {
            $report->delete();
        }

        $maintenance->delete();

        return Redirect::route('maintenances.index')
            ->with('success', 'Maintenance and associated report deleted successfully');
    }
}

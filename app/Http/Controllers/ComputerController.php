<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Client;
use App\Models\Computer;
use App\Models\PcModel;
use App\Models\PcType;
use App\Models\Ubication;
use App\Notifications\CreatedComputerNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ComputerRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use App\Notifications\DeletedComputerNotification;
use App\Notifications\UpdatedComputerNotification;
use App\Services\ActivityService;
use Yajra\DataTables\Facades\DataTables;

class ComputerController extends Controller
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
        $this->authorize('viewAny', Computer::class);

        $computersQuery = $this->activityService->getActivitiesQuery($request, Computer::class);

        if ($request->ajax()) {
            return DataTables::of($computersQuery)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('computers.show', $row->id) . '" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-eye"></i> Mostrar</a>';
                    $btn .= ' <a href="' . route('computers.edit', $row->id) . '" class="btn btn-sm btn-success"><i class="fa fa-fw fa-edit"></i> Editar</a>';
                    $btn .= ' <form action="' . route('computers.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Estas seguro que deseas eliminar?\')"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                              </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('computer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Computer::class);
        $computer = new Computer();
        $brands = Brand::all();
        $pcModels = PcModel::all();
        $pcTypes = PcType::all();
        $ubications = Ubication::all();
        $clients = $this->getClients($request);

        return view('computer.create', compact('computer', 'brands', 'pcModels', 'pcTypes', 'ubications', 'clients'));
    }

    private function getClients(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('admin')) {
            return Client::all();
        } elseif ($user->hasRole('employee')) {
            return Client::where('created_by', $user->id)->get();
        } else {
            return collect(); // Empty collection for other roles
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComputerRequest $request): RedirectResponse
    {
        $this->authorize('create', Computer::class);
        $computer = Computer::create($request->validated());

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployeesAndClients(new CreatedComputerNotification($computer, Auth::user()));

        return Redirect::route('computers.index')
            ->with('success', 'Computer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $computer = Computer::find($id);
        $this->authorize('view', $computer);

        return view('computer.show', compact('computer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request): View
    {
        $computer = Computer::find($id);
        $this->authorize('update', $computer);
        $brands = Brand::all();
        $pcModels = PcModel::all();
        $pcTypes = PcType::all();
        $ubications = Ubication::all();
        $clients = $this->getClients($request);

        return view('computer.edit', compact('computer', 'brands', 'pcModels', 'pcTypes', 'ubications', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComputerRequest $request, Computer $computer): RedirectResponse
    {
        $this->authorize('update', $computer);
        $computer->update($request->validated());

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployeesAndClients(new UpdatedComputerNotification($computer, Auth::user()));

        return Redirect::route('computers.index')
            ->with('success', 'Computer updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $computer = Computer::find($id);

        $this->authorize('delete', $computer);

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployeesAndClients(new DeletedComputerNotification($computer, Auth::user()));

        $computer->delete();

        return Redirect::route('computers.index')
            ->with('success', 'Computer deleted successfully');
    }
}

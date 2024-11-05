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

    public function index(Request $request): View
    {
        $this->authorize('viewAny', Computer::class);

        $computersQuery = $this->activityService->getActivitiesQuery($request, Computer::class);

        if ($computersQuery instanceof \Illuminate\Support\Collection) {
            $computers = $computersQuery;
        } else {
            $computers = $computersQuery->paginate(5);
        }

        return view('computer.index', compact('computers'));
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

        $user = $request->user();

        if ($user->hasRole('admin')) {
            $clients = Client::all();
        } elseif ($user->hasRole('employee')) {
            $clients = Client::where('created_by', $user->id)->get();
        } else {
            $clients = collect(); // Empty collection for other roles
        }

        return view('computer.create', compact('computer', 'brands', 'pcModels', 'pcTypes', 'ubications', 'clients'));
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
    public function edit($id): View
    {
        $computer = Computer::find($id);
        $this->authorize('update', $computer);
        $brands = Brand::all();
        $pcModels = PcModel::all();
        $pcTypes = PcType::all();
        $ubications = Ubication::all();
        $clients = Client::all();

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

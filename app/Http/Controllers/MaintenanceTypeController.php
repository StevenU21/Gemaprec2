<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceType;
use App\Notifications\CreatedMaintenanceTypeNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MaintenanceTypeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UpdatedMaintenanceTypeNotification;
use App\Notifications\DeletedMaintenanceTypeNotification;

class MaintenanceTypeController extends Controller
{
    use AuthorizesRequests;

    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('viewAny', MaintenanceType::class);
        $maintenanceTypes = MaintenanceType::paginate(5);

        return view('maintenance-type.index', compact('maintenanceTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', MaintenanceType::class);
        $maintenanceType = new MaintenanceType();

        return view('maintenance-type.create', compact('maintenanceType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaintenanceTypeRequest $request): RedirectResponse
    {
        $this->authorize('create', MaintenanceType::class);
        $maintenanceType = MaintenanceType::create($request->validated());

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployees(new CreatedMaintenanceTypeNotification($maintenanceType, Auth::user()));

        return Redirect::route('maintenance-types.index')
            ->with('success', 'MaintenanceType created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $maintenanceType = MaintenanceType::find($id);
        $this->authorize('view', $maintenanceType);

        return view('maintenance-type.show', compact('maintenanceType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $maintenanceType = MaintenanceType::find($id);
        $this->authorize('update', $maintenanceType);

        return view('maintenance-type.edit', compact('maintenanceType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MaintenanceTypeRequest $request, MaintenanceType $maintenanceType): RedirectResponse
    {
        $this->authorize('update', $maintenanceType);
        $maintenanceType->update($request->validated());

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployees(new UpdatedMaintenanceTypeNotification($maintenanceType, Auth::user()));

        return Redirect::route('maintenance-types.index')
            ->with('success', 'MaintenanceType updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $maintenanceType = MaintenanceType::find($id);

        $this->authorize('delete', $maintenanceType);

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployees(new DeletedMaintenanceTypeNotification($maintenanceType, Auth::user()));

        $maintenanceType->delete();

        return Redirect::route('maintenance-types.index')
            ->with('success', 'MaintenanceType deleted successfully');
    }
}

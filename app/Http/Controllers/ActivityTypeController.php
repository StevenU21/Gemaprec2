<?php

namespace App\Http\Controllers;

use App\Models\ActivityType;
use App\Notifications\CreatedActivityTypeNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ActivityTypeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UpdatedActivityTypeNotification;
use App\Notifications\DeletedActivityTypeNotification;

class ActivityTypeController extends Controller
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
        $this->authorize('viewAny', ActivityType::class);
        $activityTypes = ActivityType::paginate(5);

        return view('activity-type.index', compact('activityTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', ActivityType::class);
        $activityType = new ActivityType();

        return view('activity-type.create', compact('activityType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityTypeRequest $request): RedirectResponse
    {
        $this->authorize('create', ActivityType::class);
        $activityType = ActivityType::create($request->validated());

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployees(new CreatedActivityTypeNotification($activityType, Auth::user()));

        return Redirect::route('activity-types.index')
            ->with('success', 'ActivityType created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $activityType = ActivityType::find($id);
        $this->authorize('view', $activityType);

        return view('activity-type.show', compact('activityType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $activityType = ActivityType::find($id);
        $this->authorize('update', $activityType);

        return view('activity-type.edit', compact('activityType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActivityTypeRequest $request, ActivityType $activityType): RedirectResponse
    {
        $this->authorize('update', $activityType);
        $activityType->update($request->validated());

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployees(new UpdatedActivityTypeNotification($activityType, Auth::user()));

        return Redirect::route('activity-types.index')
            ->with('success', 'ActivityType updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $activityType = ActivityType::find($id);

        $this->authorize('delete', $activityType);

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployees(new DeletedActivityTypeNotification($activityType, Auth::user()));

        $activityType->delete();

        return Redirect::route('activity-types.index')
            ->with('success', 'ActivityType deleted successfully');
    }
}

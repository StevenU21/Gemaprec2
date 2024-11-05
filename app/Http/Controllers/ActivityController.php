<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityType;
use App\Models\Maintenance;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ActivityRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CreatedActivityNotification;
use App\Notifications\DeletedActivityNotification;
use App\Notifications\UpdatedActivityNotification;
use App\Services\ActivityService;

class ActivityController extends Controller
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
        $this->authorize('viewAny', Activity::class);

        $activitiesQuery = $this->activityService->getActivitiesQuery($request, Activity::class);

        if ($activitiesQuery instanceof \Illuminate\Support\Collection) {
            $activities = $activitiesQuery;
        } else {
            $activities = $activitiesQuery->paginate(5);
        }

        return view('activity.index', compact('activities'));
    }

    public function getEvents()
    {
        $activities = Activity::all();

        $events = [];

        foreach ($activities as $activity) {
            $events[] = [
                'title' => $activity->description,
                'start' => $activity->start_date,
                'end' => $activity->end_date,
                'maintenance' => $activity->maintenance->description,
                'url' => route('activities.show', $activity->id),
                'color' => 'orange',
            ];
        }

        return response()->json($events);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', Activity::class);
        $activity = new Activity();
        $activityTypes = ActivityType::all();
        $maintenances = Maintenance::all();

        return view('activity.create', compact('activity', 'activityTypes', 'maintenances'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityRequest $request): RedirectResponse
    {
        $this->authorize('create', Activity::class);
        $maintenance = Maintenance::find($request->maintenance_id);

        $activity = Activity::create($request->validated() +
            [
                'user_id' => auth()->id(),
                'maintenance_id' => $request->maintenance_id,
            ]);

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployeesAndClients(new CreatedActivityNotification($activity, Auth::user()));

        // Obtener el reporte asociado al mantenimiento
        $report = Report::where('maintenance_id', $maintenance->id)->first();

        if ($report) {
            // Concatenar la nueva actividad a la descripción del reporte
            $newDescription = $report->description . "\n" . now()->toDateTimeString() . ': New Activity - ' . $activity->description;
            $report->update([
                'description' => $newDescription,
            ]);
        }

        return Redirect::route('activities.index')
            ->with('success', 'Activity created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $activity = Activity::with('user')->find($id);
        $this->authorize('view', $activity);

        return view('activity.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $activity = Activity::find($id);
        $this->authorize('update', $activity);
        $users = User::all();

        return view('activity.edit', compact('activity', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActivityRequest $request, Activity $activity): RedirectResponse
    {
        $this->authorize('update', $activity);
        $activity->update($request->validated());

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployeesAndClients(new UpdatedActivityNotification($activity, Auth::user()));

        // Obtener el reporte asociado al mantenimiento
        $report = Report::where('maintenance_id', $activity->maintenance_id)->first();

        if ($report) {
            // Concatenar la actualización de la actividad a la descripción del reporte
            $newDescription = $report->description . "\n" . now()->toDateTimeString() . ': Updated Activity - ' . $activity->description;
            $report->update([
                'description' => $newDescription,
            ]);
        }

        return Redirect::route('activities.index')
            ->with('success', 'Activity updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $activity = Activity::find($id);

        $this->authorize('delete', $activity);

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployeesAndClients(new DeletedActivityNotification($activity, Auth::user()));

        // Obtener el reporte asociado al mantenimiento
        $report = Report::where('maintenance_id', $activity->maintenance_id)->first();

        if ($report) {
            // Concatenar la eliminación de la actividad a la descripción del reporte
            $newDescription = $report->description . "\n" . now()->toDateTimeString() . ': Deleted Activity - ' . $activity->description;
            $report->update([
                'description' => $newDescription,
            ]);
        }

        $activity->delete();

        return Redirect::route('activities.index')
            ->with('success', 'Activity deleted successfully');
    }
}

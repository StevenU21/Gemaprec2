<?php

namespace App\Http\Controllers;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendars.index');
    }
    public function events(Request $request)
    {
        $this->authorize('viewAny', Maintenance::class);

        $user = $request->user();
        $query = $this->getMaintenanceQuery($user);

        if (!$query) {
            return response()->json([]);
        }

        $maintenances = $query->get();
        $events = $this->generateEvents($maintenances);

        return response()->json($events);
    }

    private function getMaintenanceQuery($user)
    {
        $query = Maintenance::query();

        if ($user->hasRole('admin')) {
            $query->with('activities', 'computer.client.user');
        } elseif ($user->hasRole('employee')) {
            $query->with('activities', 'computer.client.user')
                ->whereHas('computer.client', function ($query) use ($user) {
                    $query->where('created_by', $user->id);
                });
        } elseif ($user->hasRole('client')) {
            $query->with('activities', 'computer.client.user')
                ->whereHas('computer', function ($query) use ($user) {
                    $query->where('client_id', $user->client->id);
                });
        } else {
            return null;
        }

        return $query;
    }

    private function generateEvents($maintenances)
    {
        $events = [];

        foreach ($maintenances as $maintenance) {
            $events[] = $this->createMaintenanceEvent($maintenance);

            foreach ($maintenance->activities as $activity) {
                $events[] = $this->createActivityEvent($activity, $maintenance);
            }
        }

        return $events;
    }

    private function createMaintenanceEvent($maintenance)
    {
        return [
            'id' => "maintenance_" . $maintenance->id,
            'groupId' => "group_" . $maintenance->id,
            'title' => $maintenance->code . ' Mantenimiento: ' . $maintenance->computer->client->user->name,
            'start' => $maintenance->start_date,
            'end' => $maintenance->end_date,
            'color' => 'blue',
            'type' => 'maintenance',
        ];
    }

    private function createActivityEvent($activity, $maintenance)
    {
        return [
            'id' => "activity_" . $activity->id,
            'groupId' => "group_" . $maintenance->id,
            'title' => ' Actividad: ' . $activity->description,
            'start' => $activity->start_date,
            'end' => $activity->end_date,
            'maintenance' => $maintenance->description,
            'url' => route('activities.show', $activity->id),
            'color' => 'orange',
            'type' => 'activity',
        ];
    }

}

<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\MaintenanceType;
use App\Models\PcModel;
use App\Models\PcType;
use App\Models\ActivityType;
use App\Models\Ubication;
use App\Models\Activity;
use App\Models\Maintenance;
use App\Models\User;
use App\Models\Client;
use App\Models\Computer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getCatalogCounts()
    {
        $brandCount = Brand::count();
        $pcModelCount = PcModel::count();
        $pcTypeCount = PcType::count();
        $activityTypeCount = ActivityType::count();
        $ubicationsCount = Ubication::count();
        $maintenanceTypeCount = MaintenanceType::count();

        return response()->json([
            'brandCount' => $brandCount,
            'pcModelCount' => $pcModelCount,
            'pcTypeCount' => $pcTypeCount,
            'activityTypeCount' => $activityTypeCount,
            'ubicationsCount' => $ubicationsCount,
            'maintenanceTypeCount' => $maintenanceTypeCount,
        ]);
    }
    public function getUpcomingActivities()
    {
        $today = now();
        $endOfYear = now()->endOfYear();
        $upcomingActivities = Activity::whereBetween('start_date', [$today, $endOfYear])
            ->get(['description', 'start_date', 'end_date', 'maintenance_id', 'activity_type_id']);

        return response()->json($upcomingActivities);
    }

    public function getUpcomingMaintenances()
    {
        $today = now();
        $endOfYear = now()->endOfYear();
        $upcomingMaintenances = Maintenance::whereBetween('start_date', [$today, $endOfYear])
            ->get(['code', 'description', 'start_date', 'end_date', 'observations', 'status', 'computer_id', 'maintenance_type_id']);

        return response()->json($upcomingMaintenances);
    }
    public function getTopEmployees()
    {
        $employees = User::role('employee')->get();

        $employeeClientCounts = $employees->map(function ($employee) {
            $clientCount = Client::where('created_by', $employee->id)->count();
            return [
                'employee' => $employee,
                'clientCount' => $clientCount
            ];
        });

        $sortedEmployees = $employeeClientCounts->sortByDesc('clientCount')->values();

        $topEmployees = $sortedEmployees->take(5);

        return response()->json($topEmployees);
    }
    public function getTopClientsByComputers()
    {
        // Obtener todos los clientes con la relación user
        $clients = Client::with('user')->get();

        // Contar el número de computadoras asociadas a cada cliente
        $clientComputerCounts = $clients->map(function ($client) {
            $computerCount = Computer::where('client_id', $client->id)->count();
            return [
                'client' => $client,
                'computerCount' => $computerCount
            ];
        });

        // Ordenar los clientes por el número de computadoras en orden descendente
        $sortedClients = $clientComputerCounts->sortByDesc('computerCount')->values();

        // Limitar el resultado a los 5 primeros clientes
        $topClients = $sortedClients->take(5);

        return response()->json($topClients->map(function ($item) {
            return [
                'clientName' => $item['client']->user->name,
                'computerCount' => $item['computerCount']
            ];
        }));
    }
    public function getMaintenanceCountsByStatus()
    {
        $pendingCount = Maintenance::where('status', 'pending')->count();
        $inProgressCount = Maintenance::where('status', 'in_progress')->count();
        $completedCount = Maintenance::where('status', 'completed')->count();

        return response()->json([
            'pending' => $pendingCount,
            'in_progress' => $inProgressCount,
            'completed' => $completedCount,
        ]);
    }

    public function getMaintenanceTypeCounts()
    {
        $maintenanceTypes = MaintenanceType::all();

        $maintenanceTypeCounts = $maintenanceTypes->map(function ($type) {
            $count = Maintenance::where('maintenance_type_id', $type->id)->count();
            return [
                'type' => $type->name,
                'count' => $count
            ];
        });

        $sortedMaintenanceTypes = $maintenanceTypeCounts->sortByDesc('count')->values();

        return response()->json($sortedMaintenanceTypes);
    }
}

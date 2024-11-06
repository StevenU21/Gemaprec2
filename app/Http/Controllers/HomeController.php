<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\MaintenanceType;
use App\Models\PcModel;
use App\Models\PcType;
use App\Models\ActivityType;
use App\Models\Ubication;

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
}

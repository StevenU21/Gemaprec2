<?php

namespace App\Providers;

use App\Models\ActivityType;
use App\Models\Brand;
use App\Models\Client;
use App\Models\Computer;
use App\Models\MaintenanceType;
use App\Models\Maintenance;
use App\Models\PcModel;
use App\Models\PcType;
use App\Models\Report;
use App\Models\Ubication;
use App\Policies\ActivityTypePolicy;
use App\Policies\BrandPolicy;
use App\Policies\ClientPolicy;
use App\Policies\ComputerPolicy;
use App\Policies\MaintenanceTypePolicy;
use App\Policies\MaintenancePolicy;
use App\Policies\PcModelPolicy;
use App\Policies\PcTypePolicy;
use App\Policies\ReportPolicy;
use App\Policies\UbicationPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Policies\ActivityPolicy;
use App\Models\Activity;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Gate::policy(Brand::class, BrandPolicy::class);
        Gate::policy(PcModel::class, PcModelPolicy::class);
        Gate::policy(PcType::class, PcTypePolicy::class);
        Gate::policy(Ubication::class, UbicationPolicy::class);
        Gate::policy(Client::class, ClientPolicy::class);
        Gate::policy(ActivityType::class, ActivityTypePolicy::class);
        Gate::policy(MaintenanceType::class, MaintenanceTypePolicy::class);
        Gate::policy(Maintenance::class, MaintenancePolicy::class);
        Gate::policy(Computer::class, ComputerPolicy::class);
        Gate::policy(Activity::class, ActivityPolicy::class);
        Gate::policy(Report::class, ReportPolicy::class);
    }
}

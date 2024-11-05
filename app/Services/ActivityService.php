<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Maintenance;
use App\Models\Computer;
use App\Models\Report;

class ActivityService
{
    public function getActivitiesQuery(Request $request, string $model): Builder
    {
        $user = $request->user();
        $query = $model::query();

        if ($user->hasRole('admin')) {
            $query->with($this->getRelations($model));
        } elseif ($user->hasRole('employee')) {
            $query->with($this->getRelations($model))
                ->whereHas($this->getEmployeeWhereHas($model), function ($query) use ($user) {
                    $query->where('created_by', $user->id);
                });
        } elseif ($user->hasRole('client')) {
            if ($model === Computer::class) {
                $query->with($this->getRelations($model))
                    ->where('client_id', $user->client->id);
            } else {
                $query->with($this->getRelations($model))
                    ->whereHas($this->getClientWhereHas($model), function ($query) use ($user) {
                        $query->where('client_id', $user->client->id);
                    });
            }
        } else {
            $query = collect();
        }

        return $query;
    }

    private function getRelations(string $model): array
    {
        $relations = [
            Activity::class => [
                'maintenance' => function ($query) {
                    $query->with([
                        'computer' => function ($query) {
                            $query->with('client.user');
                        }
                    ]);
                },
                'activityType',
            ],
            Maintenance::class => [
                'computer.client.user',
                'maintenanceType'
            ],
            Computer::class => [
                'brand',
                'pcModel',
                'pcType',
                'ubication',
                'client.user'
            ],
            Report::class => [
                'maintenance.computer.client.user',
                'client.user'
            ]
        ];

        return $relations[$model] ?? [];
    }

    private function getEmployeeWhereHas(string $model): string
    {
        $whereHas = [
            Activity::class => 'maintenance.computer.client',
            Maintenance::class => 'computer.client',
            Computer::class => 'client',
            Report::class => 'maintenance.computer.client'
        ];

        return $whereHas[$model] ?? '';
    }

    private function getClientWhereHas(string $model): string
    {
        $whereHas = [
            Activity::class => 'maintenance.computer',
            Maintenance::class => 'computer',
            Computer::class => 'client',
            Report::class => 'maintenance.computer'
        ];

        return $whereHas[$model] ?? '';
    }
}

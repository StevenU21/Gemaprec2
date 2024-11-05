<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class MaintenanceType
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property Maintenance[] $maintenances
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class MaintenanceType extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    use LogsActivity;
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'description'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'description']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function maintenances()
    {
        return $this->hasMany(\App\Models\Maintenance::class, 'id', 'maintenance_type_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\VisibleToUser;

/**
 * Class Maintenance
 *
 * @property $id
 * @property $description
 * @property $start_date
 * @property $end_date
 * @property $observations
 * @property $status
 * @property $computer_id
 * @property $maintenance_type_id
 * @property $created_at
 * @property $updated_at
 *
 * @property MaintenanceType $maintenanceType
 * @property User $user
 * @property Computer $computer
 * @property Activity[] $activities
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Maintenance extends Model
{
    use LogsActivity, VisibleToUser, HasFactory;
    protected $perPage = 20;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['code', 'description', 'start_date', 'end_date', 'observations', 'status', 'computer_id', 'maintenance_type_id']);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['code', 'description', 'start_date', 'end_date', 'observations', 'status', 'computer_id', 'maintenance_type_id'];

    public function activities()
    {
        // Cambia 'id' por 'maintenance_id' en la relación hasMany
        return $this->hasMany(\App\Models\Activity::class, 'maintenance_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function maintenanceType()
    {
        return $this->belongsTo(\App\Models\MaintenanceType::class, 'maintenance_type_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function computer()
    {
        return $this->belongsTo(\App\Models\Computer::class, 'computer_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function reports()
    {
        return $this->hasMany(\App\Models\Report::class, 'id', 'maintenance_id');
    }
}

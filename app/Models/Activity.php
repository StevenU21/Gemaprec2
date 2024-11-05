<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Activity
 *
 * @property $id
 * @property $message
 * @property $type
 * @property $date
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property Report[] $reports
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Activity extends Model
{
    use LogsActivity;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['description', 'start_date', 'end_date', 'maintenance_id', 'activity_type_id'];

    public function maintenance()
    {
        return $this->belongsTo(\App\Models\Maintenance::class, 'maintenance_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports()
    {
        return $this->hasMany(\App\Models\Report::class, 'id', 'activity_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activityType()
    {
        return $this->belongsTo(\App\Models\ActivityType::class, 'activity_type_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['description', 'date', 'maintenance_id', 'activity_type_id']);
    }

}

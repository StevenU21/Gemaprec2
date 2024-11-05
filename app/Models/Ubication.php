<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Ubication
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $address
 * @property $created_at
 * @property $updated_at
 *
 * @property Computer[] $computers
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ubication extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    use LogsActivity;
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'description', 'address'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'description', 'address']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function computers()
    {
        return $this->hasMany(\App\Models\Computer::class, 'id', 'ubications_id');
    }
}

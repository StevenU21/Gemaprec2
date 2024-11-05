<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\VisibleToUser;

/**
 * Class Computer
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $serial_number
 * @property $mac_address
 * @property $adquisition_date
 * @property $status
 * @property $brand_id
 * @property $pc_model_id
 * @property $ubications_id
 * @property $pc_type_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Brand $brand
 * @property PcModel $pcModel
 * @property PcType $pcType
 * @property Ubication $ubication
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Computer extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    use LogsActivity;
    use VisibleToUser;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'description', 'serial_number', 'mac_address', 'adquisition_date', 'status', 'brand_id', 'pc_model_id', 'ubications_id', 'pc_type_id', 'client_id', 'created_by']);
    }
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'serial_number',
        'mac_address',
        'adquisition_date',
        'status',
        'brand_id',
        'pc_model_id',
        'ubications_id',
        'pc_type_id',
        'client_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(\App\Models\Brand::class, 'brand_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pcModel()
    {
        return $this->belongsTo(\App\Models\PcModel::class, 'pc_model_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pcType()
    {
        return $this->belongsTo(\App\Models\PcType::class, 'pc_type_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ubication()
    {
        return $this->belongsTo(\App\Models\Ubication::class, 'ubications_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class, 'client_id', 'id');
    }

    //formatear fecha
    public function getAdquisitionDateAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }
}

<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class DeviceMotel
 * @package App\Models
 * @version September 29, 2017, 2:51 am UTC
 */
class DeviceMotel extends Model
{

    public $table = 'device_motels';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'device_id',
        'motel_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'device_id' => 'integer',
        'motel_id' => 'integer'
    ];

     /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function device()
    {
        return $this->belongsTo(\App\Models\Device::class, 'device_id', 'id');
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function motel()
    {
        return $this->belongsTo(\App\Models\Motel::class, 'motel_id', 'id');
    }




}

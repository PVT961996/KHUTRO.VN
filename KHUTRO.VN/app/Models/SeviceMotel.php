<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class SeviceMotel
 * @package App\Models
 * @version September 29, 2017, 2:52 am UTC
 */
class SeviceMotel extends Model
{

    public $table = 'sevice_motels';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'sevice_id',
        'motel_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'sevice_id' => 'integer',
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
    public function sevice()
    {
        return $this->belongsTo(\App\Models\Sevice::class, 'device_id', 'id');
    }

        /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function motel()
    {
        return $this->belongsTo(\App\Models\Motel::class, 'motel_id', 'id');
    }




}

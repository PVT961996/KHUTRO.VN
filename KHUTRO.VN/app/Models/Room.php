<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class Room
 * @package App\Models
 * @version September 29, 2017, 2:53 am UTC
 */
class Room extends Model
{

    public $table = 'rooms';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'motel_id',
        'area',
        'number_people',
        'price',
        'status',
        'toilet',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'motel_id' => 'integer',
        'area' => 'string',
        'number_people' => 'integer',
        'price' => 'string',
        'status' => 'string',
        'toilet' => 'string',
        'description' => 'string'
    ];

     /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:255',
        'area' => 'max:255',
        'number_people' => 'max:100',
        'price' => 'max:255',
        'status' => 'max:255',
        'toilet' => 'radio,Khép Kín,Chung'
    ];

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function motel()
    {
        return $this->belongsTo(\App\Models\Motel::class, 'motel_id', 'id');
    }




}

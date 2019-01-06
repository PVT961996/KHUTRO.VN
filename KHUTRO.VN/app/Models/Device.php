<?php

namespace App\Models;

use Eloquent as Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Device
 * @package App\Models
 * @version September 29, 2017, 1:50 am UTC
 */
class Device extends Model
{
    use SoftDeletes;

    public $table = 'devices';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'order',
        'icon',
        'image',
        'class_css',
        'slug'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'order' => 'integer',
        'icon' => 'string',
        'image' => 'string',
        'class_css' => 'string',
        'slug' => 'string'
    ];

     /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:255',
        'icon' => 'max:255',
        'image' => 'max:255',
        'class_css' => 'max:255'
    ];





    use Sluggable;

    /**
    * Return the sluggable configuration array for this model.
    *
    * @return array
    */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function motels()
    {
        return $this->belongsToMany('App\Models\Motel', 'device_motels', 'device_id', 'motel_id');
    }
}

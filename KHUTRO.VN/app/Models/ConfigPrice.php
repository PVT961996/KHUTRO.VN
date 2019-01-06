<?php

namespace App\Models;

use Eloquent as Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class ConfigPrice
 * @package App\Models
 * @version September 29, 2017, 2:04 am UTC
 */
class ConfigPrice extends Model
{

    public $table = 'config_prices';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'number_views',
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
        'number_views' => 'integer',
        'slug' => 'string'
    ];

     /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:255'
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
}

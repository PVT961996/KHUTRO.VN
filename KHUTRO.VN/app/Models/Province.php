<?php

namespace App\Models;

use Eloquent as Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class Province
 * @package App\Models
 * @version September 29, 2017, 1:57 am UTC
 */
class Province extends Model
{
    use Sluggable;

    public $table = 'provinces';


    public $fillable = [
        'name',
        'description',
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
        'slug' => 'string'
    ];

     /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required | max:255',
        'description' => 'required'
    ];



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

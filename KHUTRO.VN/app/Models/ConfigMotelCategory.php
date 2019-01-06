<?php

namespace App\Models;

use Eloquent as Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ConfigMotelCategory
 * @package App\Models
 * @version September 29, 2017, 2:44 am UTC
 */
class ConfigMotelCategory extends Model
{
    use SoftDeletes;

    public $table = 'config_motel_categories';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'field_name',
        'motel_category_id',
        'description',
        'html_type',
        'db_type',
        'default_value',
        'location',
        'icon',
        'image',
        'class_css',
        'order',
        'slug'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'field_name' => 'string',
        'motel_category_id' => 'integer',
        'description' => 'string',
        'html_type' => 'string',
        'db_type' => 'string',
        'default_value' => 'string',
        'location' => 'string',
        'icon' => 'string',
        'image' => 'string',
        'class_css' => 'string',
        'order' => 'integer',
        'slug' => 'string'
    ];

     /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'field_name' => 'required|max:255',
        'html_type' => 'max:255',
        'db_type' => 'max:255',
        'location' => 'max:255',
        'icon' => 'max:255',
        'image' => 'max:255',
        'class_css' => 'max:255',
        'order' => 'required|max:50'
    ];

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function motelCategory()
    {
        return $this->belongsTo(\App\Models\MotelCategory::class, 'motel_category_id', 'id');
    }



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
                'source' => 'field_name'
            ]
        ];
    }
}

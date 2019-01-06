<?php

namespace App\Models;

use Eloquent as Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class Motel
 * @package App\Models
 * @version September 29, 2017, 2:41 am UTC
 */
class Motel extends Model
{

    public $table = 'motels';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'slug',
        'user_id',
        'motel_category_id',
        'min_price',
        'max_price',
        'area',
        'address',
        'province_id',
        'district_id',
        'town_id',
        'street_id',
        'views',
        'due_date',
        'short_description',
        'featured',
        'status',
        'image_title',
        'config_price_id',
        'deposits',
        'original_id',
        'seo_title',
        'seo_tag',
        'seo_description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'user_id' => 'integer',
        'motel_category_id' => 'integer',
        'min_price' => 'double',
        'max_price' => 'double',
        'area' => 'integer',
        'address' => 'string',
        'province_id' => 'integer',
        'district_id' => 'integer',
        'town_id' => 'integer',
        'street_id' => 'integer',
        'views' => 'integer',
        'short_description' => 'string',
        'featured' => 'integer',
        'status' => 'integer',
        'image_title' => 'string',
        'config_price_id' => 'integer',
        'deposits' => 'string',
        'original_id' => 'integer',
        'seo_title' => 'string',
        'seo_tag' => 'string',
        'seo_description' => 'string'
    ];

     /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|max:255',
        'address' => 'required|max:255',
        'deposits' => 'max:255',
        'seo_title' => 'max:255',
        'seo_tag' => 'max:50',
        'seo_description' => 'max:500'
    ];

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

        /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function motelCategory()
    {
        return $this->belongsTo(\App\Models\MotelCategory::class, 'motel_category_id', 'id');
    }

        /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function province()
    {
        return $this->belongsTo(\App\Models\Province::class, 'province_id', 'id');
    }

        /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function district()
    {
        return $this->belongsTo(\App\Models\District::class, 'district_id', 'id');
    }

        /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function town()
    {
        return $this->belongsTo(\App\Models\Town::class, 'town_id', 'id');
    }

        /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function street()
    {
        return $this->belongsTo(\App\Models\Street::class, 'street_id', 'id');
    }

        /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function configPrice()
    {
        return $this->belongsTo(\App\Models\ConfigPrice::class, 'config_price_id', 'id');
    }

        /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function parent()
    {
        return $this->belongsTo(\App\Models\Motel::class, 'original_id', 'id');
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    **/
    public function children($columns=['*'])
    {
        return $this->hasMany(\App\Models\Motel::class, 'original_id', 'id')->get($columns);
    }


    public function devices()
    {
        return $this->belongsToMany('App\Models\Device', 'device_motels', 'motel_id', 'device_id');
    }
    public function sevices()
    {
        return $this->belongsToMany('App\Models\Sevice', 'sevice_motels', 'motel_id', 'sevice_id');
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
                'source' => 'title'
            ]
        ];
    }
}

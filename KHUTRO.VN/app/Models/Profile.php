<?php

namespace App\Models;

use Eloquent as Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Profile
 * @package App\Models
 * @version September 29, 2017, 2:07 am UTC
 */
class Profile extends Model
{
    use SoftDeletes;

    public $table = 'profiles';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'user_id',
        'motel_category_id',
        'short_description',
        'image_title',
        'address',
        'area',
        'province_id',
        'district_id',
        'town_id',
        'due_date',
        'content',
        'seo_title',
        'seo_tag',
        'seo_description',
        'slug'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'user_id' => 'integer',
        'motel_category_id' => 'integer',
        'short_description' => 'string',
        'image_title' => 'string',
        'address' => 'string',
        'area' => 'integer',
        'province_id' => 'integer',
        'district_id' => 'integer',
        'town_id' => 'integer',
        'content' => 'string',
        'seo_title' => 'string',
        'seo_tag' => 'string',
        'seo_description' => 'string',
        'slug' => 'string'
    ];

     /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|max:255',
        'image_title' => 'max:255',
        'address' => 'max:255',
        'area' => 'max:1000000',
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

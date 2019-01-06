<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class MotelCategory
 * @package App\Models
 * @version September 29, 2017, 1:55 am UTC
 */
class MotelCategory extends Model
{
    public $table = 'motel_categories';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'parent_id',
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
        'parent_id' => 'integer',
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

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function parent()
    {
        return $this->belongsTo(\App\Models\MotelCategory::class, 'parent_id', 'id');
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    **/
    public function children($columns=['*'])
    {
        return $this->hasMany(\App\Models\MotelCategory::class, 'parent_id', 'id')->get($columns);
    }

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

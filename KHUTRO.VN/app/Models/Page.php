<?php

namespace App\Models;

use Eloquent as Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Page
 * @package App\Models
 * @version August 1, 2017, 3:29 am UTC
 */
class Page extends Model
{
    use SoftDeletes;

    public $table = 'pages';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'content',
        'user_id',
        'parent_id',
        'slug'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'content' => 'string',
        'user_id' => 'integer',
        'parent_id' => 'integer',
        'slug' => 'string'
    ];

     /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|max:255'
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
    public function parent()
    {
        return $this->belongsTo(\App\Models\Page::class, 'parent_id', 'id');
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    **/
    public function children($columns=['*'])
    {
        return $this->hasMany(\App\Models\Page::class, 'parent_id', 'id')->get($columns);
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

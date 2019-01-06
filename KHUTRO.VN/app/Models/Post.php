<?php

namespace App\Models;

use Eloquent as Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class Post
 * @package App\Models
 * @version September 29, 2017, 2:29 am UTC
 */
class Post extends Model
{


    public $table = 'posts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'user_id',
        'short_description',
        'content',
        'image_title',
        'seo_title',
        'seo_tag',
        'seo_description',
        'slug',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'user_id' => 'integer',
        'short_description' => 'string',
        'content' => 'string',
        'image_title' => 'string',
        'seo_title' => 'string',
        'seo_tag' => 'string',
        'seo_description' => 'string',
        'slug' => 'string',
        'status' => 'integer'
    ];

     /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|max:255',
        'image_title' => 'max:255',
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

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'post_tags', 'post_id', 'tag_id');
    }

    public function postCategories()
    {
        return $this->belongsToMany('App\Models\PostCategory', 'category_posts', 'post_id', 'post_category_id');
    }

    public function postComments()
    {
        return $this->hasMany(\App\Models\CommentPost::class)->whereNull('parent_id')->orderBy('created_at','desc');
    }

    public function lastComment()
    {
        return $this->hasOne(\App\Models\CommentPost::class,'post_id', 'id')->orderBy('created_at','desc');
    }

    public function commentsByUpdated()
    {
        return $this->hasMany(\App\Models\CommentPost::class)->whereNull('parent_id')->orderBy('updated_at', 'desc');
    }

}

<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CommentPost
 * @package App\Models
 * @version September 29, 2017, 2:39 am UTC
 */
class CommentPost extends Model
{
    use SoftDeletes;

    public $table = 'comment_posts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'post_id',
        'parent_id',
        'content'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'post_id' => 'integer',
        'parent_id' => 'integer',
        'content' => 'string'
    ];

     /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
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
    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class, 'post_id', 'id');
    }

        /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function parent()
    {
        return $this->belongsTo(\App\Models\CommentPost::class, 'parent_id', 'id');
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    **/
    public function children($columns=['*'])
    {
        return $this->hasMany(\App\Models\CommentPost::class, 'parent_id', 'id')->get($columns);
    }


}

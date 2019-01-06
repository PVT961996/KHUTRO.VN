<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class CategoryPost
 * @package App\Models
 * @version September 29, 2017, 3:37 am UTC
 */
class CategoryPost extends Model
{

    public $table = 'category_posts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'post_category_id',
        'post_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'post_category_id' => 'integer',
        'post_id' => 'integer'
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
    public function postCategory()
    {
        return $this->belongsTo(\App\Models\PostCategory::class, 'post_category_id', 'id');
    }

        /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class, 'post_id', 'id');
    }




}

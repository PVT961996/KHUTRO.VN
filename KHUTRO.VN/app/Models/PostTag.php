<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PostTag
 * @package App\Models
 * @version September 29, 2017, 2:37 am UTC
 */
class PostTag extends Model
{
    use SoftDeletes;

    public $table = 'post_tags';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'post_id',
        'tag_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'post_id' => 'integer',
        'tag_id' => 'integer'
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
    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class, 'post_id', 'id');
    }

        /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function tag()
    {
        return $this->belongsTo(\App\Models\Tag::class, 'tag_id', 'id');
    }




}

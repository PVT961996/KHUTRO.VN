<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FeedbackProfile
 * @package App\Models
 * @version September 29, 2017, 2:09 am UTC
 */
class FeedbackProfile extends Model
{
    use SoftDeletes;

    public $table = 'feedback_profiles';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'profile_id',
        'parent_id',
        'content',
        'rate_score'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'profile_id' => 'integer',
        'parent_id' => 'integer',
        'content' => 'string',
        'rate_score' => 'integer'
    ];

     /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'rate_score' => 'max:10'
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
    public function profile()
    {
        return $this->belongsTo(\App\Models\Profile::class, 'profile_id', 'id');
    }

        /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function parent()
    {
        return $this->belongsTo(\App\Models\FeedbackProfile::class, 'parent_id', 'id');
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    **/
    public function children($columns=['*'])
    {
        return $this->hasMany(\App\Models\FeedbackProfile::class, 'parent_id', 'id')->get($columns);
    }


}

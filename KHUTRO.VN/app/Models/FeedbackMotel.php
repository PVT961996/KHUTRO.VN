<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FeedbackMotel
 * @package App\Models
 * @version September 29, 2017, 2:54 am UTC
 */
class FeedbackMotel extends Model
{
    use SoftDeletes;

    public $table = 'feedback_motels';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'motel_id',
        'feedback_type',
        'content',
        'phone_number'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'motel_id' => 'integer',
        'feedback_type' => 'integer',
        'content' => 'string',
        'phone_number' => 'string'
    ];

     /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'phone_number' => 'max:13'
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
    public function motel()
    {
        return $this->belongsTo(\App\Models\Motel::class, 'motel_id', 'id');
    }

        /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function feedbackMotelType()
    {
        return $this->belongsTo(\App\Models\FeedbackMotelType::class, 'feedback_type', 'id');
    }




}

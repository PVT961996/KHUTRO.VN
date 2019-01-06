<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MotelSave
 * @package App\Models
 * @version September 29, 2017, 2:52 am UTC
 */
class MotelSave extends Model
{
    use SoftDeletes;

    public $table = 'motel_saves';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'motel_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'motel_id' => 'integer'
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
    public function motel()
    {
        return $this->belongsTo(\App\Models\Motel::class, 'motel_id', 'id');
    }




}

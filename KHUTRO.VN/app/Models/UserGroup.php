<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserGroup
 * @package App\Models
 * @version July 14, 2017, 3:30 am UTC
 */
class UserGroup extends Model
{
    use SoftDeletes;

    public $table = 'user_groups';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'group_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'group_id' => 'integer'
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
    public function group()
    {
        return $this->belongsTo(\App\Models\Group::class, 'group_id', 'id');
    }




}

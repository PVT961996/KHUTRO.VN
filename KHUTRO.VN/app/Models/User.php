<?php

namespace App\Models;

use Eloquent as Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App\Models
 * @version July 14, 2017, 4:01 am UTC
 */
class User extends Model
{
    use SoftDeletes;

    public $table = 'users';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'age',
        'sex',
        'password',
        'address',
        'email',
        'phone_number',
        'card_id',
        'issued_card',
        'job',
        'description',
        'slug',
        'avatar'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'age' => 'integer',
        'sex' => 'integer',
        'password' => 'string',
        'address' => 'string',
        'email' => 'string',
        'phone_number' => 'string',
        'card_id' => 'string',
        'issued_card' => 'string',
        'job' => 'string',
        'description' => 'string',
        'slug' => 'string',
        'avatar' => 'string'
    ];

     /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:50',
        'age' => 'required',
        'email' => 'required|unique:users,email',
        'card_id' => 'numeric',
    ];

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
                'source' => 'name'
            ]
        ];
    }

    public function groups()
    {
        return $this->belongsToMany('App\Models\Group', 'user_groups', 'user_id', 'group_id');
    }

    public function menus()
    {
        return $this->belongsToMany('App\Models\Menu', 'user_menus', 'user_id', 'menu_id');

    }
}

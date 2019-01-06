<?php

namespace App\Models;

use Eloquent as Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Group
 * @package App\Models
 * @version July 14, 2017, 3:28 am UTC
 */
class Group extends Model
{
    use SoftDeletes;

    public $table = 'groups';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'slug'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'slug' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required | max:50'
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


    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_groups', 'group_id', 'user_id');
    }

    public function menus()
    {
        return $this->belongsToMany('App\Models\GroupMenu', 'group_menus', 'group_id', 'menu_id');
    }

}

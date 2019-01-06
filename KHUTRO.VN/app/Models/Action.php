<?php

namespace App\Models;

use Eloquent as Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Action
 * @package App\Models
 * @version July 14, 2017, 3:32 am UTC
 */
class Action extends Model
{
    use SoftDeletes;

    public $table = 'actions';
    

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
        'name' => 'required'
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

    public function tables()
    {
        return $this->belongsToMany('App\Models\Table', 'menus', 'action_id', 'table_id');
    }

}

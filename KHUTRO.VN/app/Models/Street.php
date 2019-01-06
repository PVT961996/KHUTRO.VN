<?php

namespace App\Models;

use Eloquent as Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class Street
 * @package App\Models
 * @version September 29, 2017, 2:02 am UTC
 */
class Street extends Model
{
    use Sluggable;

    public $table = 'streets';
    



    public $fillable = [
        'name',
        'town_id',
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
        'town_id' => 'integer',
        'description' => 'string',
        'slug' => 'string'
    ];

     /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:255'
    ];

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function town()
    {
        return $this->belongsTo(\App\Models\Town::class, 'town_id', 'id');
    }


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
}

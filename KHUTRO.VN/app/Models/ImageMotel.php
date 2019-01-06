<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ImageMotel
 * @package App\Models
 * @version September 29, 2017, 2:50 am UTC
 */
class ImageMotel extends Model
{
    use SoftDeletes;

    public $table = 'image_motels';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'image',
        'motel_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'image' => 'string',
        'motel_id' => 'integer'
    ];

     /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'image' => 'max:255'
    ];

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function motel()
    {
        return $this->belongsTo(\App\Models\Motel::class, 'motel_id', 'id');
    }




}

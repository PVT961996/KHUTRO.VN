<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class ValueConfigMotel
 * @package App\Models
 * @version September 29, 2017, 2:47 am UTC
 */
class ValueConfigMotel extends Model
{

    public $table = 'value_config_motels';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'config_category_id',
        'value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'config_category_id' => 'integer',
        'value' => 'string'
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
    public function configMotelCategory()
    {
        return $this->belongsTo(\App\Models\ConfigMotelCategory::class, 'config_category_id', 'id');
    }




}

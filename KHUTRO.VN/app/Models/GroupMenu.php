<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class GroupMenu
 * @package App\Models
 * @version July 14, 2017, 3:35 am UTC
 */
class GroupMenu extends Model
{

    public $table = 'group_menus';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'group_id',
        'menu_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'group_id' => 'integer',
        'menu_id' => 'integer'
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
    public function group()
    {
        return $this->belongsTo(\App\Models\Group::class, 'group_id', 'id');
    }

        /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function menu()
    {
        return $this->belongsTo(\App\Models\Menu::class, 'menu_id', 'id');
    }
}

<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Menu
 * @package App\Models
 * @version July 14, 2017, 3:34 am UTC
 */
class Menu extends Model
{
    use SoftDeletes;

    public $table = 'menus';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'action_id',
        'table_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'action_id' => 'integer',
        'table_id' => 'integer'
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
    public function action()
    {
        return $this->belongsTo(\App\Models\Action::class, 'action_id', 'id');
    }

        /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function model_table()
    {
        return $this->belongsTo(\App\Models\Table::class, 'table_id', 'id');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Models\Group', 'group_menus', 'menu_id', 'group_id');
    }
}

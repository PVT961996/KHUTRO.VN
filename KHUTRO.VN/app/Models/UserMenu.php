<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserMenu
 * @package App\Models
 * @version July 14, 2017, 3:34 am UTC
 */
class UserMenu extends Model
{
    use SoftDeletes;

    public $table = 'user_menus';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'menu_id',
        'flag'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'menu_id' => 'integer',
        'flag' => 'integer'
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
    public function menu()
    {
        return $this->belongsTo(\App\Models\Menu::class, 'menu_id', 'id');
    }
}

<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StaticMenu
 * @package App\Models
 * @version August 1, 2017, 3:30 am UTC
 */
class StaticMenu extends Model
{
    use SoftDeletes;

    public $table = 'static_menus';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'link',
        'parent_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'link' => 'string',
        'parent_id' => 'integer'
    ];

     /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|max:255'
    ];

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/

    public function page()
    {
        return $this->belongsTo(\App\Models\Page::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\StaticMenu::class, 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function children($columns=['*'])
    {
        return $this->hasMany(\App\Models\StaticMenu::class, 'parent_id', 'id')->get($columns);
    }
}

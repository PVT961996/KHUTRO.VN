<?php

namespace App\Repositories;

use App\Models\Menu;
use BloomGoo\Generator\Common\BaseRepository;

class MenuRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Menu::class;
    }
}

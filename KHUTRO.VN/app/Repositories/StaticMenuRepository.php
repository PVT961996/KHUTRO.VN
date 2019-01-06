<?php

namespace App\Repositories;

use App\Models\StaticMenu;
use BloomGoo\Generator\Common\BaseRepository;

class StaticMenuRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return StaticMenu::class;
    }
}

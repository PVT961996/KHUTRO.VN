<?php

namespace App\Repositories;

use App\Models\GroupMenu;
use BloomGoo\Generator\Common\BaseRepository;

class GroupMenuRepository extends BaseRepository
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
        return GroupMenu::class;
    }
}

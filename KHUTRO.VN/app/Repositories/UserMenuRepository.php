<?php

namespace App\Repositories;

use App\Models\UserMenu;
use BloomGoo\Generator\Common\BaseRepository;

class UserMenuRepository extends BaseRepository
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
        return UserMenu::class;
    }
}

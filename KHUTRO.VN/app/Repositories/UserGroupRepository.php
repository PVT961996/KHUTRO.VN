<?php

namespace App\Repositories;

use App\Models\UserGroup;
use BloomGoo\Generator\Common\BaseRepository;

class UserGroupRepository extends BaseRepository
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
        return UserGroup::class;
    }
}

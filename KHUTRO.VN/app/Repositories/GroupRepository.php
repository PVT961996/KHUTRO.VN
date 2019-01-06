<?php

namespace App\Repositories;

use App\Models\Group;
use BloomGoo\Generator\Common\BaseRepository;

class GroupRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'=>'like'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Group::class;
    }
}

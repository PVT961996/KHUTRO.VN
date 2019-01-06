<?php

namespace App\Repositories;

use App\Models\Action;
use BloomGoo\Generator\Common\BaseRepository;

class ActionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Action::class;
    }
}

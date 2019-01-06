<?php

namespace App\Repositories;

use App\Models\Town;
use BloomGoo\Generator\Common\BaseRepository;

class TownRepository extends BaseRepository
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
        return Town::class;
    }
}

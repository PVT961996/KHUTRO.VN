<?php

namespace App\Repositories;

use App\Models\Street;
use BloomGoo\Generator\Common\BaseRepository;

class StreetRepository extends BaseRepository
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
        return Street::class;
    }
}

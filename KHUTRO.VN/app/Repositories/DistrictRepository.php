<?php

namespace App\Repositories;

use App\Models\District;
use BloomGoo\Generator\Common\BaseRepository;

class DistrictRepository extends BaseRepository
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
        return District::class;
    }
}

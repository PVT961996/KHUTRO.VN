<?php

namespace App\Repositories;

use App\Models\Province;
use BloomGoo\Generator\Common\BaseRepository;

class ProvinceRepository extends BaseRepository
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
        return Province::class;
    }
}

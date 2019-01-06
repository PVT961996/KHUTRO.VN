<?php

namespace App\Repositories;

use App\Models\ConfigPrice;
use BloomGoo\Generator\Common\BaseRepository;

class ConfigPriceRepository extends BaseRepository
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
        return ConfigPrice::class;
    }
}

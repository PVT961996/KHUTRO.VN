<?php

namespace App\Repositories;

use App\Models\DeviceMotel;
use BloomGoo\Generator\Common\BaseRepository;

class DeviceMotelRepository extends BaseRepository
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
        return DeviceMotel::class;
    }
}

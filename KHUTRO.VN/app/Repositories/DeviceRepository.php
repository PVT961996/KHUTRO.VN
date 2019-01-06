<?php

namespace App\Repositories;

use App\Models\Device;
use BloomGoo\Generator\Common\BaseRepository;

class DeviceRepository extends BaseRepository
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
        return Device::class;
    }
}

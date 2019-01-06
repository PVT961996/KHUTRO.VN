<?php

namespace App\Repositories;

use App\Models\Sevice;
use BloomGoo\Generator\Common\BaseRepository;

class SeviceRepository extends BaseRepository
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
        return Sevice::class;
    }
}

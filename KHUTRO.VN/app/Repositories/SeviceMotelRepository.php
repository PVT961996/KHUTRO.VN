<?php

namespace App\Repositories;

use App\Models\SeviceMotel;
use BloomGoo\Generator\Common\BaseRepository;

class SeviceMotelRepository extends BaseRepository
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
        return SeviceMotel::class;
    }
}

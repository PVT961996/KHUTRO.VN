<?php

namespace App\Repositories;

use App\Models\ValueConfigMotel;
use BloomGoo\Generator\Common\BaseRepository;

class ValueConfigMotelRepository extends BaseRepository
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
        return ValueConfigMotel::class;
    }
}

<?php

namespace App\Repositories;

use App\Models\MotelSave;
use BloomGoo\Generator\Common\BaseRepository;

class MotelSaveRepository extends BaseRepository
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
        return MotelSave::class;
    }
}

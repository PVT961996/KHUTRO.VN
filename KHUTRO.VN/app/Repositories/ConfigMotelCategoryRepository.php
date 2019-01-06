<?php

namespace App\Repositories;

use App\Models\ConfigMotelCategory;
use BloomGoo\Generator\Common\BaseRepository;

class ConfigMotelCategoryRepository extends BaseRepository
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
        return ConfigMotelCategory::class;
    }
}

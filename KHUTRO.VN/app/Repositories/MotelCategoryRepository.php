<?php

namespace App\Repositories;

use App\Models\MotelCategory;
use BloomGoo\Generator\Common\BaseRepository;

class MotelCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MotelCategory::class;
    }
}

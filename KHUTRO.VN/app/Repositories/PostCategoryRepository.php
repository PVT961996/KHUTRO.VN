<?php

namespace App\Repositories;

use App\Models\PostCategory;
use BloomGoo\Generator\Common\BaseRepository;

class PostCategoryRepository extends BaseRepository
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
        return PostCategory::class;
    }
}

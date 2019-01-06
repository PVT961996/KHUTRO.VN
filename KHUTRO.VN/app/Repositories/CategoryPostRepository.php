<?php

namespace App\Repositories;

use App\Models\CategoryPost;
use BloomGoo\Generator\Common\BaseRepository;

class CategoryPostRepository extends BaseRepository
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
        return CategoryPost::class;
    }
}

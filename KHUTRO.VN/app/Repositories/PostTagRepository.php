<?php

namespace App\Repositories;

use App\Models\PostTag;
use BloomGoo\Generator\Common\BaseRepository;

class PostTagRepository extends BaseRepository
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
        return PostTag::class;
    }
}

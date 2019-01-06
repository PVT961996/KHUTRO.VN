<?php

namespace App\Repositories;

use App\Models\CommentPost;
use BloomGoo\Generator\Common\BaseRepository;

class CommentPostRepository extends BaseRepository
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
        return CommentPost::class;
    }
}

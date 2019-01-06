<?php

namespace App\Repositories;

use App\Models\FeedbackMotel;
use BloomGoo\Generator\Common\BaseRepository;

class FeedbackMotelRepository extends BaseRepository
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
        return FeedbackMotel::class;
    }
}

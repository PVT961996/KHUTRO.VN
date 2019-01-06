<?php

namespace App\Repositories;

use App\Models\FeedbackMotelType;
use BloomGoo\Generator\Common\BaseRepository;

class FeedbackMotelTypeRepository extends BaseRepository
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
        return FeedbackMotelType::class;
    }
}

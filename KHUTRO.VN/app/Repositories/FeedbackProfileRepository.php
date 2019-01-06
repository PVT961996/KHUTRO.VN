<?php

namespace App\Repositories;

use App\Models\FeedbackProfile;
use BloomGoo\Generator\Common\BaseRepository;

class FeedbackProfileRepository extends BaseRepository
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
        return FeedbackProfile::class;
    }
}

<?php

namespace App\Repositories;

use App\Models\Profile;
use BloomGoo\Generator\Common\BaseRepository;

class ProfileRepository extends BaseRepository
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
        return Profile::class;
    }
}

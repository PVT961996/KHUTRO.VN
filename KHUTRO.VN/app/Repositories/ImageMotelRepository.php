<?php

namespace App\Repositories;

use App\Models\ImageMotel;
use BloomGoo\Generator\Common\BaseRepository;

class ImageMotelRepository extends BaseRepository
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
        return ImageMotel::class;
    }
}

<?php

namespace App\Repositories;

use App\Models\History;
use BloomGoo\Generator\Common\BaseRepository;

class HistoryRepository extends BaseRepository
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
        return History::class;
    }
}

<?php

namespace App\Repositories;

use App\Models\Room;
use BloomGoo\Generator\Common\BaseRepository;

class RoomRepository extends BaseRepository
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
        return Room::class;
    }
}

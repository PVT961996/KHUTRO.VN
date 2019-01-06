<?php

namespace App\Repositories;

use App\Models\Table;
use BloomGoo\Generator\Common\BaseRepository;

class TableRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Table::class;
    }
}

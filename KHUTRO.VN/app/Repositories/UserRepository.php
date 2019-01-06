<?php

namespace App\Repositories;

use App\Models\User;
use BloomGoo\Generator\Common\BaseRepository;

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'=>'like',
        'email'=>'like',
        'card_id'=>'like'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function search($where, $relationsId = null, $is_paging = true)
    {
        $this->applyConditions($where);
        if (!empty($relationsId)) {
            if ($is_paging)
                $documents = $this->model->with('groups')->join('user_groups', function ($join) {
                    $join->on('users.id', '=', 'user_groups.user_id');
                })->where('user_groups.group_id', $relationsId)->whereNull('user_groups.deleted_at')->paginate(16, ['users.*']);
            else
                $documents = $this->model->with('groups')->join('user_groups', function ($join) {
                    $join->on('users.id', '=', 'user_groups.user_id');
                })->where('user_groups.group_id', $relationsId)->whereNull('document_categories.deleted_at')->get(['users.*']);
        } else {
            if ($is_paging)
                $documents = $this->model->with('users')->paginate(16);
            else
                $documents = $this->model->with('users')->get(['users.*']);
        }
        return $documents;
    }
}

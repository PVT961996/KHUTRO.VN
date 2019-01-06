<?php

namespace App\Repositories;

use App\Models\Post;
use BloomGoo\Generator\Common\BaseRepository;

class PostRepository extends BaseRepository
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
        return Post::class;
    }

    public function search($where,$paginate=false,$limit = 10, $user,$category) {
        $this->applyConditions($where);
        if($user==''&&empty($category)){
            $posts = $this->model->paginate($limit, ['posts.*']);
            $this->resetModel();
            return $posts;
        }
        if($user==''){
            $posts = $this->model->join('category_posts', function ($join) {
                $join->on('posts.id', '=', 'category_posts.post_id');
            })->where('category_posts.post_category_id',$category);
        }
        elseif (empty($category)){
            $posts = $this->model->join('users', function($join){
                $join->on('posts.user_id', '=', 'users.id');
            })->where([['users.name','LIKE','%'.$user.'%']]);
        }
        else{
            $posts = $this->model->join('category_posts', function ($join) {
                $join->on('posts.id', '=', 'category_posts.post_id');
            })->where('category_posts.post_category_id',$category)
                ->join('post_categories', function ($join) {
                    $join->on('category_posts.post_category_id', '=', 'post_categories.id');
                })->join('users', function($join){
                    $join->on('posts.user_id', '=', 'users.id');
                })->where([['users.name','LIKE','%'.$user.'%']])
                ->whereNull('post_categories.deleted_at');
        }

        if($paginate){
            $posts = $posts->paginate($limit, ['posts.*']);
        }
        else{
            $posts = $posts->all(['posts.*']);
        }

        $this->resetModel();
        return $posts;
    }
}

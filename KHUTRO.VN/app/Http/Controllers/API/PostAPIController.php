<?php

namespace App\Http\Controllers\API;

use App\Repositories\PostRepository;
use App\Http\Controllers\AppBaseController;
use Response;



class PostAPIController extends AppBaseController
{
    /** @var  PostRepository */
    private $postRepository;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepository = $postRepo;
    }


    public function actives($id)
    {
        $post = $this->postRepository->findWithoutFail($id);
        if (empty($post)) {
            return $this->sendError('User not found');
        }
        if($post->status){
            $post->status  = 0;
        }else{
            $post->status  = 1;
        }
        $post->save();

        return $this->sendResponse($post->toArray(), 'Post updated successfully');
    }
}

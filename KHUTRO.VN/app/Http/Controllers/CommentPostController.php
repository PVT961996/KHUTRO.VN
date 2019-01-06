<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentPostRequest;
use App\Http\Requests\UpdateCommentPostRequest;
use App\Repositories\CommentPostRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CommentPostController extends AppBaseController
{
    /** @var  CommentPostRepository */
    private $commentPostRepository;

    public function __construct(CommentPostRepository $commentPostRepo)
    {
        $this->commentPostRepository = $commentPostRepo;
    }

    /**
     * Display a listing of the CommentPost.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->commentPostRepository->pushCriteria(new RequestCriteria($request));
        $commentPosts = $this->commentPostRepository->all();

        return view('backend.comment_posts.index')
            ->with('commentPosts', $commentPosts);
    }

    /**
     * Show the form for creating a new CommentPost.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.comment_posts.create');
    }

    /**
     * Store a newly created CommentPost in storage.
     *
     * @param CreateCommentPostRequest $request
     *
     * @return Response
     */
    public function store(CreateCommentPostRequest $request)
    {
        $input = $request->all();

        $commentPost = $this->commentPostRepository->create($input);

        Flash::success('Comment Post saved successfully.');

        return redirect(route('admin.commentPosts.index'));
    }

    /**
     * Display the specified CommentPost.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $commentPost = $this->commentPostRepository->findWithoutFail($id);

        if (empty($commentPost)) {
            Flash::error('Comment Post not found');

            return redirect(route('admin.commentPosts.index'));
        }

        return view('backend.comment_posts.show')->with('commentPost', $commentPost);
    }

    /**
     * Show the form for editing the specified CommentPost.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $commentPost = $this->commentPostRepository->findWithoutFail($id);

        if (empty($commentPost)) {
            Flash::error('Comment Post not found');

            return redirect(route('admin.commentPosts.index'));
        }

        return view('backend.comment_posts.edit')->with('commentPost', $commentPost);
    }

    /**
     * Update the specified CommentPost in storage.
     *
     * @param  int              $id
     * @param UpdateCommentPostRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCommentPostRequest $request)
    {
        $commentPost = $this->commentPostRepository->findWithoutFail($id);

        if (empty($commentPost)) {
            Flash::error('Comment Post not found');

            return redirect(route('admin.commentPosts.index'));
        }

        $commentPost = $this->commentPostRepository->update($request->all(), $id);

        Flash::success('Comment Post updated successfully.');

        return redirect(route('admin.commentPosts.index'));
    }

    /**
     * Remove the specified CommentPost from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $commentPost = $this->commentPostRepository->findWithoutFail($id);

        if (empty($commentPost)) {
            Flash::error('Comment Post not found');

            return redirect(route('admin.commentPosts.index'));
        }

        $this->commentPostRepository->delete($id);

        Flash::success('Comment Post deleted successfully.');

        return redirect(route('admin.commentPosts.index'));
    }
}

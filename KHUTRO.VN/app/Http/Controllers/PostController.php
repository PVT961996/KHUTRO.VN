<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\CategoryPostRepository;
use App\Repositories\PostCategoryRepository;
use App\Repositories\PostRepository;
use App\Repositories\PostTagRepository;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PostController extends AppBaseController
{
    /** @var  PostRepository */
    private $postRepository;
    private $postCategoryRepository;
    private $tagRepository;
    private $categotyPostReposytory;
    private $postTagrepository;
    private $post = "Bài Viết";
    public function __construct(PostRepository $postRepo, PostCategoryRepository $postCategoryRepo, TagRepository $tagRepo, CategoryPostRepository $categoryPostRepo, PostTagRepository $postTagRepo)
    {
        $this->postRepository = $postRepo;
        $this->postCategoryRepository = $postCategoryRepo;
        $this->tagRepository = $tagRepo;
        $this->categotyPostReposytory = $categoryPostRepo;
        $this->postTagrepository = $postTagRepo;
    }

    /**
     * Display a listing of the Post.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search=$request->search;
        $postCategories = $this->postCategoryRepository->all();
        $selectBoxCategory = [0=>'-----Chọn danh mục ('.count($postCategories).')-----'];
        foreach ($postCategories as $category){
            $selectBoxCategory[$category->id]=$category->name;
        }
        if(!empty($search['title']&&$search['category']=='0'&&empty($search['user']))){
            $posts = $this->postRepository->findByField('title','LIKE','%'.$search['title'].'%',['*'],true,10);
            return view('backend.posts.index',compact('selectBoxCategory'))
                ->with('posts', $posts);
        }

        $searchCondition = [];

        if(!empty($search)){
            $u=null; $c='0'; $title = '';
            if(!empty($search['title'])){
                array_push($searchCondition,['title','LIKE','%'.$search['title'].'%']);
            }
            if(!empty($search['user'])){
                $u = $search['user'];
            }
            if(($search['category']!='0')){
                $c = $search['category'];
            }
            if($u==null&&$c=='0'&&$title==''){
                $posts = $this->postRepository->paginate(10);
                return view('backend.posts.index',compact('selectBoxCategory'))
                    ->with('posts', $posts);
            }
            $posts = $this->postRepository->search($searchCondition,true,10,$u,$c);

        }
        else{
            $posts = $this->postRepository->paginate(10);
        }

        return view('backend.posts.index',compact('selectBoxCategory'))
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new Post.
     *
     * @return Response
     */
    public function create()
    {
        $postCategories= $this->postCategoryRepository->buildTree('name',['*']);
        $tags = $this->tagRepository->all();
        return view('backend.posts.create',compact('tags','postCategories'));
    }

    /**
     * Store a newly created Post in storage.
     *
     * @param CreatePostRequest $request
     *
     * @return Response
     */
    public function store(CreatePostRequest $request)
    {
        $input = $request->all();
        if (!empty($input['image_title'])) {
            $imageName = time().'.'.transText($request->image_title->getClientOriginalName(),'-');
            $request->image_title->move(public_path('uploads/posts'), $imageName);
            $request->image_title = $imageName;
            $input['image_title'] = '/uploads/posts/'.$imageName;
        }
        $input['user_id'] = Auth::id();
        $input['status'] = 0;
        $post = $this->postRepository->create($input);

        $tag_ids = $request->tag_ids;
        $category_ids = $request->category_ids;
        $post->tags()->sync($tag_ids);
        $post->postCategories()->sync($category_ids);
        Flash::success(__("messages.add_successfully").$this->post);
        if($input['save']==='save_edit'){
            return redirect(route('admin.posts.edit', $post->id));
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.posts.create'));
        }
        else{
            return redirect(route('admin.posts.index'));
        }
    }

    /**
     * Display the specified Post.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            Flash::error(__("messages.not_found").$this->post);

            return redirect(route('admin.posts.index'));
        }

        $comments = $post->postComments();
        return view('backend.posts.show',compact('comments'))->with('post', $post);
    }

    /**
     * Show the form for editing the specified Post.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            Flash::error(__("messages.not_found").$this->post);
            return redirect(route('admin.posts.index'));
        }
        $categories = $this->postCategoryRepository->all();
        $current_category_ids = $post->postCategories;
        $tags = $this->tagRepository->all();
        $current_tag_ids = $post->tags;

        return view('backend.posts.edit',compact('categories','tags','current_category_ids','current_tag_ids'))->with('post', $post);
    }

    /**
     * Update the specified Post in storage.
     *
     * @param  int              $id
     * @param UpdatePostRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostRequest $request)
    {
        $input = $request->all();
        $post = $this->postRepository->findWithoutFail($id);
        if (empty($post)) {
            Flash::error(__("messages.not_found").$this->post);
            return redirect(route('admin.posts.index'));
        }
        if (!empty($input['image_title'])) {
            $imageName = time().'.'.transText($request->image_title->getClientOriginalName(),'-');
            $request->image_title->move(public_path('uploads/posts'), $imageName);
            $request->image_title = $imageName;
            $input['image_title'] = '/uploads/posts/'.$imageName;
        }
        $post = $this->postRepository->update($input, $id);
        $category_ids = $request->category_ids;
        $post->postCategories()->sync($category_ids);
        $tag_ids = $request->tag_ids;
        $post->tags()->sync($tag_ids);
        Flash::success(__('messages.update_successfully'));
        if($input['save']==='save_edit'){
            return back()->withInput();
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.posts.create'));
        }
        else{
            return redirect(route('admin.posts.index'));
        }
    }

    /**
     * Remove the specified Post from storage.
     *
     * @param  int $id
     *
     * @return Response
     */

    private function checkPosts($ids){
        foreach ($ids as $id){
            $post = $this->postRepository->findWithoutFail($id);
            if (empty($post)) {
                return false;
            }
        }
        return true;
    }

    public function destroy($id,Request $request)
    {
        if($id=='MULTI'){
            if($request->ids!=null){
                $ids = $request->ids;
                // Neu xuat hien loi khong xoa gi ca. Đưa ra lỗi
                if($this->checkPosts($ids)){
                    foreach ($ids as $id) {
                        $categoryPosts = $this->categotyPostReposytory->findWhere([['post_id', '=', $id]]);
                        foreach ($categoryPosts as $categoryPost) {
                            $this->categotyPostReposytory->delete($categoryPost->id);
                        }
                        $postTags = $this->postTagrepository->findWhere([['post_id', '=', $id]]);
                        foreach ($postTags as $postTag) {
                            $this->postTagrepository->delete($postTag->id);
                        }
                    }

                    $this->postRepository->destroy_multiple($request->ids);
                    Flash::success(__('messages.delete_successfully').$this->post);
                }
                else{
                    Flash::error(__('messages.not_found').$this->post);
                }
                return redirect(route('admin.posts.index'));
            }
            else{
                Flash::error(__('messages.no_value_select'));
                return redirect(route('admin.posts.index'));
            }
        }
        else{
            $post = $this->postRepository->findWithoutFail($id);

            if (empty($post)) {
                Flash::error(__('messages.not_found').$this->post);

                return redirect(route('admin.posts.index'));
            }

            $this->postRepository->delete($id);

            Flash::success(__('messages.delete_successfully').$this->post);

            return redirect(route('admin.posts.index'));
        }
    }

    public function duplicate($id)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            Flash::error(__('messages.not_found').$this->post);
            return redirect(route('admin.posts.index'));
        }
        $post->status=0;
        $tags=$this->tagRepository->all();
        $current_tag_ids = $post->tags;
        $categories = $this->postCategoryRepository->all();
        $current_category_ids = $post->postCategories;
        $type = 'DUPLICATE';
        return view('backend.posts.edit', compact('type','tags','current_tag_ids','categories','current_category_ids'))->with('post', $post);
    }

    public function active($id,Request $request){
        $post = $this->postRepository->findWithoutFail($id);
        if (empty($post)) {
            Flash::error(__('messages.not_found').$this->post);

            return redirect(route('admin.posts.index'));
        }
        $submit_type = $request->submit_type;
        if($submit_type==='ACTIVE'){
            $post->status  = 1;
        }else{
            $post->status  = 0;
        }
        $post->save();
        Flash::success(__('messages.active_successfully').$this->post);
        return redirect(route('admin.posts.index'));
    }
}

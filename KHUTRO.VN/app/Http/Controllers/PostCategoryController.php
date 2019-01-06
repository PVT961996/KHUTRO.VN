<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostCategoryRequest;
use App\Http\Requests\UpdatePostCategoryRequest;
use App\Repositories\PostCategoryRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PostCategoryController extends AppBaseController
{
    /** @var  PostCategoryRepository */
    private $postCategoryRepository;
    private $post_category = 'Danh Mục Bài Viết';
    public function __construct(PostCategoryRepository $postCategoryRepo)
    {
        $this->postCategoryRepository = $postCategoryRepo;
    }

    /**
     * Display a listing of the PostCategory.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $searchCondition = [];
        if(!empty($search)){
            if(!empty($search['name'])){
                array_push($searchCondition,['name','LIKE','%'.$search['name'].'%']);
            }
            $postCategories = $this->postCategoryRepository->findWhere($searchCondition,['*'],true,5);
        }else{
            $postCategories = $this->postCategoryRepository->buildTree('name');
        }

        return view('backend.post_categories.index')
            ->with('postCategories', $postCategories);
    }

    /**
     * Show the form for creating a new PostCategory.
     *
     * @return Response
     */
    public function create()
    {
        $postCategories = $this->postCategoryRepository->buildTreeForSelectBox("name",['id', 'name'], '-');
        return view('backend.post_categories.create',compact('postCategories'));
    }

    /**
     * Store a newly created PostCategory in storage.
     *
     * @param CreatePostCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreatePostCategoryRequest $request)
    {
        $input = $request->all();
        if($input['parent_id']=='0'){
            $input['parent_id'] = null;
        }
        $postCategory = $this->postCategoryRepository->create($input);
        Flash::success(__("messages.add_successfully").$this->post_category);
        if($input['save']==='save_edit'){
            return redirect(route('admin.postCategories.edit', $postCategory->id));
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.postCategories.create'));
        }
        else{
            return redirect(route('admin.postCategories.index'));
        }
    }

    /**
     * Display the specified PostCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $postCategory = $this->postCategoryRepository->findWithoutFail($id);

        if (empty($postCategory)) {
            Flash::error(__("messages.not_found").$this->post_category);

            return redirect(route('admin.postCategories.index'));
        }

        return view('backend.post_categories.show')->with('postCategory', $postCategory);
    }

    /**
     * Show the form for editing the specified PostCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $postCategory = $this->postCategoryRepository->findWithoutFail($id);

        if (empty($postCategory)) {
            Flash::error(__("messages.not_found").$this->post_category);

            return redirect(route('admin.postCategories.index'));
        }
        $postCategories = $this->postCategoryRepository->buildTreeForSelectBox('name',['id', 'name'], '-'  , $id);


        return view('backend.post_categories.edit',compact("postCategories"))->with('postCategory', $postCategory);
    }

    /**
     * Update the specified PostCategory in storage.
     *
     * @param  int              $id
     * @param UpdatePostCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostCategoryRequest $request)
    {
        $postCategory = $this->postCategoryRepository->findWithoutFail($id);
        $input = $request->all();
        if (empty($postCategory)) {
            Flash::error(__("messages.not_found").$this->post_category);

            return redirect(route('admin.postCategories.index'));
        }
        if($input['parent_id']=='0'){
            $input['parent_id']=null;
        }

        $postCategory = $this->postCategoryRepository->update($input, $id);

        Flash::success(__("messages.update_successfully").$this->post_category);
        if($input['save']==='save_edit'){
            return redirect(route('admin.postCategories.edit', $postCategory->id));
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.postCategories.create'));
        }
        else{
            return redirect(route('admin.postCategories.index'));
        }
    }

    /**
     * Remove the specified PostCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    private function checkPostCategory($ids){
        foreach ($ids as $id){
            $postCategory = $this->postCategoryRepository->findWithoutFail($id);
            if (empty($postCategory)) {
                return false;
            }
            else{
                if(count($postCategory->children())>0){
                    return false;
                }
            }
        }
        return true;
    }


    public function destroy($id,Request $request)
    {
        if ($id == 'MULTI') {
            $ids = $request->ids;
            if (empty($ids)) {
                Flash::warning(__("messages.no_value_select"));
                return back()->withInput();;
            } else {
                if($this->checkPostCategory($ids)){
                    $this->postCategoryRepository->destroy_multiple($ids);
                    Flash::success(__("messages.delete_successfully").$this->post_category);
                }
                else{
                    Flash::warning(__('messages.have_children'));
                    return back()->withInput();
                }
            }
            return redirect(route('admin.postCategories.index'));
        }
        else {
            $postCategory = $this->postCategoryRepository->findWithoutFail($id);
            if (empty($postCategory)) {
                Flash::error(__("messages.not_found").$this->post_category);
                return redirect(route('admin.postCategories.index'));
            }
            if(count($postCategory->children())>0){
                Flash::warning(__('messages.have_children'));
                return back()->withInput();
            }else{
                $this->postCategoryRepository->delete($id);
                Flash::success(__("messages.delete_successfully").$this->post_category);
            }
        }
        return redirect(route('admin.postCategories.index'));
    }


    public function duplicate($id){
        $postCategory = $this->postCategoryRepository->findWithoutFail($id);
        $postCategories = $this->postCategoryRepository->buildTreeForSelectBox('name',['id', 'name'], '-');

        if (empty($postCategory)) {
            Flash::error(__("messages.not_found").$this->post_category);

            return redirect(route('admin.postCategories.index'));
        }

        $type = 'DUPLICATE';

        return view('backend.post_categories.edit', compact('type', 'postCategories','postCaregory'))->with('postCategory', $postCategory);
    }
}

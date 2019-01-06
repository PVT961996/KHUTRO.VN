<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMotelCategoryRequest;
use App\Http\Requests\UpdateMotelCategoryRequest;
use App\Repositories\MotelCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MotelCategoryController extends AppBaseController
{
    /** @var  MotelCategoryRepository */
    private $motelCategoryRepository;
    private $motel_category = 'Danh Mục Bất Động Sản';
    public function __construct(MotelCategoryRepository $motelCategoryRepo)
    {
        $this->motelCategoryRepository = $motelCategoryRepo;
    }

    /**
     * Display a listing of the MotelCategory.
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
            $motelCategories = $this->motelCategoryRepository->findWhere($searchCondition,['*'],true,5);
        }else{
//            $motelCategories = $this->motelCategoryRepository->all(); // build tree
            $motelCategories = $this->motelCategoryRepository->buildTree('name');
        }

        return view('backend.motel_categories.index')
            ->with('motelCategories', $motelCategories);
    }

    /**
     * Show the form for creating a new MotelCategory.
     *
     * @return Response
     */
    public function create()
    {
        $motelCategories = $this->motelCategoryRepository->buildTreeForSelectBox("name",['id', 'name'], '-');
        return view('backend.motel_categories.create',compact('motelCategories'));
    }

    /**
     * Store a newly created MotelCategory in storage.
     *
     * @param CreateMotelCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateMotelCategoryRequest $request)
    {
        $input = $request->all();
        if($input['parent_id']=='0'){
            $input['parent_id'] = null;
        }
        $motelCategory = $this->motelCategoryRepository->create($input);
        Flash::success(__("messages.add_successfully").$this->motel_category);
        if($input['save']==='save_edit'){
            return redirect(route('admin.motelCategories.edit', $motelCategory->id));
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.motelCategories.create'));
        }
        else{
            return redirect(route('admin.motelCategories.index'));
        }
    }

    /**
     * Display the specified MotelCategory.
     *
     * @param  int $id
     *
     * @return Response
     */

    public function show($id)
    {
        $motelCategory = $this->motelCategoryRepository->findWithoutFail($id);

        if (empty($motelCategory)) {
            Flash::error(__("messages.not_found").$this->motel_category);
            return redirect(route('admin.motelCategories.index'));
        }
        return view('backend.motel_categories.show')->with('motelCategory', $motelCategory);
    }

    /**
     * Show the form for editing the specified MotelCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $motelCategory = $this->motelCategoryRepository->findWithoutFail($id);
        if (empty($motelCategory)) {
            Flash::error(__("messages.not_found").$this->motel_category);
            return redirect(route('admin.motelCategories.index'));
        }
        $motelCategories = $this->motelCategoryRepository->buildTreeForSelectBox('name',['id', 'name'], '-'  , $id);

        return view('backend.motel_categories.edit',compact('motelCategories'))->with('motelCategory', $motelCategory);
    }

    /**
     * Update the specified MotelCategory in storage.
     *
     * @param  int              $id
     * @param UpdateMotelCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMotelCategoryRequest $request)
    {
        $motelCategory = $this->motelCategoryRepository->findWithoutFail($id);
        $input = $request->all();
        if (empty($motelCategory)) {
            Flash::error(__("messages.not_found").$this->motel_category);

            return redirect(route('admin.motelCategories.index'));
        }
        if($input['parent_id']=='0'){
            $input['parent_id']=null;
        }

        $motelCategory = $this->motelCategoryRepository->update($input, $id);

        Flash::success(__("messages.update_successfully").$this->motel_category);
        if($input['save']==='save_edit'){
            return redirect(route('admin.motelCategories.edit', $motelCategory->id));
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.motelCategories.create'));
        }
        else{
            return redirect(route('admin.motelCategories.index'));
        }
    }

    /**
     * Remove the specified MotelCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    private function checkMotelCategory($ids){
        foreach ($ids as $id){
            $motelCategory = $this->motelCategoryRepository->findWithoutFail($id);
            if (empty($motelCategory)) {
                return false;
            }
            else{
                if(count($motelCategory->children())>0){
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
               if($this->checkMotelCategory($ids)){
                   $this->motelCategoryRepository->destroy_multiple($ids);
                   Flash::success(__("messages.delete_successfully").$this->motel_category);
               }
               else{
                   Flash::warning(__('messages.have_children'));
                   return back()->withInput();
               }
            }
            return redirect(route('admin.motelCategories.index'));
        } else {
            $motelCategory = $this->motelCategoryRepository->findWithoutFail($id);
            if (empty($motelCategory)) {
                Flash::error(__("messages.not_found").$this->motel_category);
                return redirect(route('admin.motelCategories.index'));
            }
            if(count($motelCategory->children())>0){
                Flash::warning(__('messages.have_children'));
                return back()->withInput();
            }else{
                $this->motelCategoryRepository->delete($id);
                Flash::success(__("messages.delete_successfully").$this->motel_category);
            }
        }
        return redirect(route('admin.motelCategories.index'));
    }

    public function export(Request $request){
        return;
    }


    public function duplicate($id){
        $motelCategory = $this->motelCategoryRepository->findWithoutFail($id);
        $motelCategories = $this->motelCategoryRepository->buildTreeForSelectBox('name',['id', 'name'], '-');

        if (empty($motelCategory)) {
            Flash::error(__("messages.not_found").$this->motel_category);

            return redirect(route('admin.motelCategories.index'));
        }

        $type = 'DUPLICATE';

        return view('backend.motel_categories.edit', compact('type', 'motelCategories','motelCaregory'))->with('motelCategory', $motelCategory);
    }
}

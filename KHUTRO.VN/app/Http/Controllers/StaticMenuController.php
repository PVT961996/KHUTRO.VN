<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStaticMenuRequest;
use App\Http\Requests\UpdateStaticMenuRequest;
use App\Repositories\StaticMenuRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class StaticMenuController extends AppBaseController
{
    /** @var  StaticMenuRepository */
    private $staticMenuRepository;

    public function __construct(StaticMenuRepository $staticMenuRepo)
    {
        $this->staticMenuRepository = $staticMenuRepo;
    }

    /**
     * Display a listing of the StaticMenu.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search=$request->search;
        $searchCondition = [];
        if(!empty($search)){
            if(!empty($search['title'])){
                array_push($searchCondition,['title','LIKE','%'.$search['title'].'%']);
            }
            $staticMenus = $this->staticMenuRepository->findWhere($searchCondition,['*'],true,10);
        }else{
            $staticMenus = $this->staticMenuRepository->paginate(10);
        }
        return view('backend.static_menus.index')
            ->with('staticMenus', $staticMenus);
    }

    /**
     * Show the form for creating a new StaticMenu.
     *
     * @return Response
     */
    public function create()
    {
        $staticMenus = $this->staticMenuRepository->buildTreeForSelectBox('title', ['*'], '-');
        return view('backend.static_menus.create', compact('staticMenus'));
    }

    /**
     * Store a newly created StaticMenu in storage.
     *
     * @param CreateStaticMenuRequest $request
     *
     * @return Response
     */
    public function store(CreateStaticMenuRequest $request)
    {
        $input = $request->all();

        if ($input['parent_id'] == 0) {
            $input['parent_id'] = null;
        }

        $staticMenu = $this->staticMenuRepository->create($input);
        if ($staticMenu->parent_id == '') {
            $staticMenu->parent_id = $staticMenu->id;
        }
        $staticMenu->save();

        Flash::success('Static Menu saved successfully.');

        if ($input['save'] === 'SAVE_EDIT') {
            return redirect(route('admin.staticMenus.edit', $staticMenu->id));
        } elseif ($input['save'] === 'SAVE_NEW') {
            return redirect(route('admin.staticMenus.create'));
        } else {
            return redirect(route('admin.staticMenus.index'));
        }
    }

    /**
     * Display the specified StaticMenu.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $staticMenu = $this->staticMenuRepository->findWithoutFail($id);

        if (empty($staticMenu)) {
            Flash::error('Static Menu not found');

            return redirect(route('admin.staticMenus.index'));
        }

        return view('backend.static_menus.show')->with('staticMenu', $staticMenu);
    }

    /**
     * Show the form for editing the specified StaticMenu.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $staticMenu = $this->staticMenuRepository->findWithoutFail($id);
        $staticMenus = $this->staticMenuRepository->buildTreeForSelectBox('title', ['*'], '-', $id);
        $parent_id = $staticMenu->id;
        if ($staticMenu->parent_id != $staticMenu->id){
            $parent_id = $staticMenu->parent_id;
        }
        if (empty($staticMenu)) {
            Flash::error('Static Menu not found');

            return redirect(route('admin.staticMenus.index'));
        }

        return view('backend.static_menus.edit', compact('parent_id', 'staticMenus'))->with('staticMenu', $staticMenu);
    }

    /**
     * Update the specified StaticMenu in storage.
     *
     * @param  int              $id
     * @param UpdateStaticMenuRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStaticMenuRequest $request)
    {
        $staticMenu = $this->staticMenuRepository->findWithoutFail($id);

        if (empty($staticMenu)) {
            Flash::error('Static Menu not found');

            return redirect(route('admin.staticMenus.index'));
        }

        $input = $request->all();

        if ($input['parent_id'] == 0) {
            $input['parent_id'] = null;
        }

        $staticMenu = $this->staticMenuRepository->update($request->all(), $id);
        if ($staticMenu->parent_id == '') {
            $staticMenu->parent_id = $staticMenu->id;
        }
        $staticMenu->save();

        Flash::success('Static Menu updated successfully.');

        if($input['save']==='SAVE_EDIT'){

            return back()->withInput();
        }
        elseif ($input['save']==='SAVE_NEW'){

            return redirect(route('admin.staticMenus.create'));
        }
        else{

            return redirect(route('admin.staticMenus.index'));
        }
    }

    /**
     * Remove the specified StaticMenu from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        if ($id == 'MULTI') {
            $ids = $request->ids;
            if (empty($ids)) {
                Flash::warning(__('No value is selected. Check again!'));
            } else {
                foreach ($ids as $id){
                    $staticMenu = $this->staticMenuRepository->findWithoutFail($id);
                    if(count($staticMenu->children())>1){
                        $message = 'Can not delete because '.$staticMenu->title.' menu contains children. Check again!';
                        Flash::warning($message);
                        return redirect(route('admin.staticMenus.index'));
                    }
                }
                $this->staticMenuRepository->destroy_multiple($ids);
                Flash::success('Static Menu deleted successfully.');
            }
        } else {
            $staticMenu = $this->staticMenuRepository->findWithoutFail($id);

            if (empty($staticMenu)) {
                Flash::error('Static Menu not found');

                return redirect(route('admin.staticMenus.index'));
            }

            $this->staticMenuRepository->delete($id);

            Flash::success('Static Menu deleted successfully.');
        }

        return redirect(route('admin.staticMenus.index'));
    }

    public function common_action(Request $request)
    {
        $submit_type = $request->submit_type;
        if ($submit_type == 'DELETE_MULTI') {
            $this->destroy('MULTI', $request);
        }
        return redirect(route('admin.staticMenus.index'));
    }

    public function duplicate($id){
        $staticMenu = $this->staticMenuRepository->findWithoutFail($id);
        $staticMenus = $this->staticMenuRepository->buildTreeForSelectBox('title', ['*'], '-', $id);
        $parent_id = $staticMenu->id;
        if ($staticMenu->parent_id != $staticMenu->id){
            $parent_id = $staticMenu->parent_id;
        }
        if (empty($staticMenu)) {
            Flash::error('Menu not found');

            return redirect(route('admin.staticMenus.index'));
        }

        $type = 'DUPLICATE';

        return view('backend.static_menus.edit', compact('type', 'staticMenus', 'parent_id'))->with('staticMenu', $staticMenu);
    }
}

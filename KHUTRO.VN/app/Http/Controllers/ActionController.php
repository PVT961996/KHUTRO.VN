<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateActionRequest;
use App\Http\Requests\UpdateActionRequest;
use App\Repositories\ActionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Repositories\MenuRepository;


class ActionController extends AppBaseController
{
    /** @var  ActionRepository */
    private $actionRepository;
    private $menuRepository;

    public function __construct(ActionRepository $actionRepo, MenuRepository $menuRepo)
    {
        $this->actionRepository = $actionRepo;
        $this->menuRepository = $menuRepo;
    }

    /**
     * Display a listing of the Action.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search=$request->search;
        $searchCondition = [];
        if(!empty($search)){
            if(!empty($search['name'])){
                array_push($searchCondition,['name','LIKE','%'.$search['name'].'%']);
            }
            $actions = $this->actionRepository->findWhere($searchCondition,['*'],true,10);
        }else{
            $actions = $this->actionRepository->paginate(10);
        }

        return view('backend.actions.index')
            ->with('actions', $actions);
    }

    /**
     * Show the form for creating a new Action.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.actions.create');
    }

    /**
     * Store a newly created Action in storage.
     *
     * @param CreateActionRequest $request
     *
     * @return Response
     */
    public function store(CreateActionRequest $request)
    {
        $input = $request->all();

        $action = $this->actionRepository->create($input);

        Flash::success('Action saved successfully.');

        if($input['save']==='save_edit'){
            return redirect(route('admin.actions.edit', $action->id));
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.actions.create'));
        }
        else{
            return redirect(route('admin.actions.index'));
        }
    }

    /**
     * Display the specified Action.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $action = $this->actionRepository->findWithoutFail($id);

        if (empty($action)) {
            Flash::error('Action not found');

            return redirect(route('admin.actions.index'));
        }

        return view('backend.actions.show')->with('action', $action);
    }

    /**
     * Show the form for editing the specified Action.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $action = $this->actionRepository->findWithoutFail($id);

        if (empty($action)) {
            Flash::error('Action not found');

            return redirect(route('admin.actions.index'));
        }

        return view('backend.actions.edit')->with('action', $action);
    }

    /**
     * Update the specified Action in storage.
     *
     * @param  int              $id
     * @param UpdateActionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActionRequest $request)
    {
        $action = $this->actionRepository->findWithoutFail($id);

        if (empty($action)) {
            Flash::error('Action not found');

            return redirect(route('admin.actions.index'));
        }

        $action = $this->actionRepository->update($request->all(), $id);

        Flash::success('Action updated successfully.');

        $input = $request->all();
        if($input['save']==='save_edit'){

            return back()->withInput();
        }
        elseif ($input['save']==='save_new'){

            return redirect(route('admin.actions.create'));
        }
        else{

            return redirect(route('admin.actions.index'));
        }
    }

    /**
     * Remove the specified Action from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        if ($id == 'MULTI'){
            $ids = $request->ids;
            if (empty($ids)){
                Flash::warning(__('No value is selected. Check again!'));
            }else{

                /*Delete related menu for this table*/
                foreach ($ids as $id){
                    $menus_related = $this->menuRepository->findWhere([['action_id', '=', $id]]);
                    foreach ($menus_related as $menu_related){
                        $this->menuRepository->delete($menu_related->id);
                    }
                }

                $this->actionRepository->destroy_multiple($ids);
                Flash::success('Action deleted successfully.');
            }

        }else{
            $action = $this->actionRepository->findWithoutFail($id);

            if (empty($action)) {
                Flash::error('Action not found');

                return redirect(route('admin.actions.index'));
            }

            /*Delete related menu for this table*/
            $menus_related = $this->menuRepository->findWhere([['action_id', '=', $id]]);
            foreach ($menus_related as $menu_related){
                $this->menuRepository->delete($menu_related->id);
            }

            $this->actionRepository->delete($id);

            Flash::success('Action deleted successfully.');

        }
        return redirect(route('admin.actions.index'));

    }

    public function duplicate($id){
        $action = $this->actionRepository->findWithoutFail($id);

        if (empty($action)) {
            Flash::error('Action not found');

            return redirect(route('admin.actions.index'));
        }

        $type = 'DUPLICATE';

        return view('backend.actions.edit', compact('type'))->with('action', $action);
    }

    public function common_action(Request $request){
        $submit_type = $request->submit_type;
        $ids = $request->ids;
        if($submit_type == 'DELETE_MULTI'){
            $this->destroy('MULTI', $request);
        }else if ($submit_type == 'ACTIVE_MULTI'){
            if (empty($ids)){
                Flash::warning(__('No value is selected. Check again!'));
            } else {
                foreach ($ids as $id){
                    $action = $this->actionRepository->findWithoutFail($id);
                    $action->active  = 1;
                    $action->save();
                }
                Flash::success('Action update active successfully.');
            }

            return redirect(route('admin.actions.index'));
        }else if ($submit_type == 'INACTIVE_MULTI'){
            if (empty($ids)){
                Flash::warning(__('No value is selected. Check again!'));
            } else {
                foreach ($ids as $id){
                    $action = $this->actionRepository->findWithoutFail($id);
                    $action->active  = 0;
                    $action->save();
                }
                Flash::success('Action update active successfully.');
            }
        }
        return redirect(route('admin.actions.index'));

    }
}

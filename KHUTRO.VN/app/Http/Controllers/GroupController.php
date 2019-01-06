<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use App\Repositories\GroupMenuRepository;
use App\Repositories\GroupRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\MenuRepository;
use App\Repositories\UserGroupRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Maatwebsite\Excel\Facades\Excel;

class GroupController extends AppBaseController
{
    /** @var  GroupRepository */
    private $groupRepository;
    private $groupMenuRepository;
    private $userGroupRepository;
    private $menuRepository;
    public function __construct(GroupRepository $groupRepo,GroupMenuRepository $groupMenuRepo, UserGroupRepository $userGroupRepo, MenuRepository $menuRepo )
    {
        $this->groupRepository = $groupRepo;
        $this->groupMenuRepository = $groupMenuRepo;
        $this->userGroupRepository = $userGroupRepo;
        $this->menuRepository = $menuRepo;
    }

    /**
     * Display a listing of the Group.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $searchCondition = [];
        if(!empty($search)){
            if(!is_null($search['id'])){
                array_push($searchCondition,['id','=', $search['id']]);
            }
            if (!is_null($search['name'])) {
                array_push($searchCondition,['name','LIKE','%'.$search['name'].'%']);
            }
            if (!is_null($search['description'])) {
                array_push($searchCondition,['description','LIKE','%'.$search['description'].'%']);
            }

            $groups = $this->groupRepository->findWhere($searchCondition);
            if (count($groups)<1) {
                Flash::error('Thông tin tìm kiếm chưa được nhập hoặc không đúng, vui lòng kiểm tra lại');
            }
            $groups = $this->groupRepository->findWhere($searchCondition,['*'],true,5);
        }else{
            $groups = $this->groupRepository->paginate(5);

        }
        return view('backend.groups.index')
            ->with('groups', $groups);
    }

    /**
     * Show the form for creating a new Group.
     *
     * @return Response
     */
    public function create()
    {
        $menus = $this->groupMenuRepository->all();
        return view('backend.groups.create', compact('menus'));
    }

    /**
     * Store a newly created Group in storage.
     *
     * @param CreateGroupRequest $request
     *
     * @return Response
     */
    public function store(CreateGroupRequest $request)
    {
        $input = $request->all();
        $group = $this->groupRepository->create($input);
        if($input['save']==='save_edit'){
            Flash::success('User saved successfully.');
            return redirect(route('admin.groups.edit',$group->id));
        }
        elseif ($input['save']==='save_new'){
            Flash::success('User saved successfully.');
            return redirect(route('admin.groups.create'));
        }
        else{
            Flash::success('User saved successfully.');

            return redirect(route('admin.groups.index'));
        }
    }

    /**
     * Display the specified Group.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $group = $this->groupRepository->findWithoutFail($id);

        if (empty($group)) {
            Flash::error('Group not found');

            return redirect(route('admin.groups.index'));
        }

        return view('backend.groups.show')->with('group', $group);
    }

    /**
     * Show the form for editing the specified Group.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $group = $this->groupRepository->findWithoutFail($id);

        if (empty($group)) {
            Flash::error('Group not found');

            return redirect(route('admin.groups.index'));
        }

        return view('backend.groups.edit')->with('group', $group);
    }

    /**
     * Update the specified Group in storage.
     *
     * @param  int              $id
     * @param UpdateGroupRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGroupRequest $request)
    {
        $input = $request->all();
        $group = $this->groupRepository->update($request->all(), $id);
        if($input['save']==='save_edit'){
            Flash::success('Group updated successfully..');
            return redirect(route('admin.groups.edit',$group->id));
        }
        elseif ($input['save']==='save_new'){
            Flash::success('Group updated successfully..');
            return redirect(route('admin.groups.create'));
        }
        else{
            Flash::success('Group updated successfully.');

            return redirect(route('admin.groups.index'));
        }
    }

    /**
     * Remove the specified Group from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id,Request $request )
    {
        if ($id == 'MULTI') {
            if (($request->ids)!=null){
                foreach ($request->ids as $id){
                    $group = $this->groupRepository->findWithoutFail($id);
                    if (empty($group)) {
                        Flash::error('Group not found');
                        return redirect(route('admin.groups.index'));
                    }
                    else{
                        $this->groupRepository->destroy_multiple($request ->ids);
                        Flash::success('Group deleted successfully.');
                        return redirect(route('admin.groups.index'));
                    }
                }
            }
            else{
                Flash::error(__('messages.category_doc_must_select_a_category_to_delete'));
                return redirect(route('admin.groups.index'));
            }
        }
        else{
            $group = $this->groupRepository->findWithoutFail($id);

            if (empty($group)) {
                Flash::error('Group not found');
                return redirect(route('admin.groups.index'));
            }

            $this->groupRepository->delete($id);

            Flash::success('Group deleted successfully.');

            return redirect(route('admin.groups.index'));
        }
    }

    public function duplicate($id)
    {
        $group = $this->groupRepository->findWithoutFail($id);

        if (empty($group)) {
            Flash::error('Table not found');

            return redirect(route('admin.groups.index'));
        }
        $type = 'DUPLICATE';
        return view('backend.groups.edit', compact('type'))->with('group', $group);
    }

    public function exportExcel(Request $request)
    {
        $type = $request->type;
        $groups = $this->groupRepository->all();
        $data = $groups->toArray();
        if ($type == 'xls') {
            Excel::create('Filename', function ($excel) use ($data) {

                $excel->sheet('Sheetname', function ($sheet) use ($data) {

                    $sheet->fromArray($data);

                });

            })->export('xls');
        } elseif ($type == 'csv') {
            Excel::create('Filename', function ($excel) use ($data) {

                $excel->sheet('Sheetname', function ($sheet) use ($data) {

                    $sheet->fromArray($data);

                });

            })->export('csv');
        }
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
                    $group = $this->groupRepository->findWithoutFail($id);
                    $group->active  = 1;
                    $group->save();
                }
                Flash::success('Group update active successfully.');
            }

            return redirect(route('admin.groups.index'));
        }else if ($submit_type == 'INACTIVE_MULTI'){
            if (empty($ids)){
                Flash::warning(__('No value is selected. Check again!'));
            } else {
                foreach ($ids as $id){
                    $group = $this->groupRepository->findWithoutFail($id);
                    $group->active  = 0;
                    $group->save();
                }
                Flash::success('Group update active successfully.');
            }
        }
        return redirect(route('admin.groups.index'));

    }
}

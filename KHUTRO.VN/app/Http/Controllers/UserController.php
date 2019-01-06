<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\GroupRepository;
use App\Repositories\MenuRepository;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Hash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;
    private $menuRepository;
    private $groupRepository;
    public function __construct(UserRepository $userRepo,MenuRepository $menuRepo,GroupRepository $groupRepo)
    {
        $this->userRepository = $userRepo;
        $this->menuRepository = $menuRepo;
        $this->groupRepository = $groupRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search=$request->search;
        $groups = $this->groupRepository->all(['id','name']);
        $selectBoxGroup = [0=>'-----Chọn nhóm ('.count($groups).')-----'];
        foreach ($groups as $group){
            $selectBoxGroup[$group->id]= $group->name ;
        }
        $searchCondition = [];
        if(!empty($search)){
            if(!empty($search['name'])){
                array_push($searchCondition,['name','LIKE','%'.$search['name'].'%']);
            }
//            if(!empty($search['email'])){
//                array_push($searchCondition,['email','LIKE','%'.$search['email'].'%']);
//            }
            if(!empty($search['phone'])){
                array_push($searchCondition,['phone_number','LIKE','%'.$search['phone'].'%']);
            }
            if(!empty($search['sex'])){
                array_push($searchCondition,['sex','=',$search['sex']]);
            }
            if(!empty($search['group'])){
                $users = $this->userRepository->search($searchCondition,$search['group'],true,10);
            }
            else{
                $users = $this->userRepository->findWhere($searchCondition,['*'],true,10);
            }
        }
        else{
            $this->userRepository->pushCriteria(new RequestCriteria($request));
            $users = $this->userRepository->paginate(10);
        }

        return view('backend.users.index',compact('selectBoxGroup'))
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $menus = $this->menuRepository->all();
        $groups = $this->groupRepository->all();
        return view('backend.users.create',compact('menus','groups'));
    }

    public function modify($menus){

    }
    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        //pass mặc định là email
        $input['password']=Hash::make($input['email']);

        if (!empty($request->avatar)) {
            $imageName = time().'.'.$request->avatar->getClientOriginalName();
            $request->avatar->move(public_path('uploads'), $imageName);
            $request->avatar = $imageName;
            $input['avatar'] = '/uploads/'.$imageName;
        }

        $user = $this->userRepository->create($input);
        $group_ids = $request->group_ids;
        $user->groups()->sync($group_ids);
        if($input['save']==='save_edit'){
            Flash::success('User saved successfully.');
            return redirect(route('admin.users.edit',$user->id));
        }
        elseif ($input['save']==='save_new'){
            Flash::success('User saved successfully.');
            return redirect(route('admin.users.create'));
        }
        else{
            Flash::success('User saved successfully.');

            return redirect(route('admin.users.index'));
        }
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('admin.users.index'));
        }

        return view('backend.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findWithoutFail($id);
        $groups = $this->groupRepository->all();
        $current_group_ids = $user->groups;
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('admin.users.index'));
        }

        return view('backend.users.edit',compact('groups','current_group_ids'))
            ->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $input = $request->all();
        $user = $this->userRepository->findWithoutFail($id);

        if (!empty($request->avatar)) {
            $imageName = time().'.'.$request->avatar->getClientOriginalName();
            $request->avatar->move(public_path('uploads'), $imageName);
            $request->avatar = $imageName;
            $input['avatar'] = '/uploads/'.$imageName;
        }


        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('admin.users.index'));
        }

        $user = $this->userRepository->update($input, $id);

        /*For relationship beetween User and Group*/
        $group_ids = $request->group_ids;
        $user->groups()->sync($group_ids);

        if($input['save']==='save_edit'){
            Flash::success('User saved successfully.');
            return back()->withInput();
        }
        elseif ($input['save']==='save_new'){
            Flash::success('User saved successfully.');
            return redirect(route('admin.users.create'));
        }
        else{
            Flash::success('User saved successfully.');

            return redirect(route('admin.users.index'));
        }
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */

    public function checkUser($ids){
        foreach ($ids as $id){
            $user = $this->userRepository->findWithoutFail($id);
            if (empty($user)) {
              return false;
            }
        }
        return true;
    }

    public function destroy($id,Request $request)
    {
        if($id==='MULTI'){
            if($request->ids!=null){
                // Neu xuat hien loi khong xoa gi ca. Đưa ra lỗi
                if($this->checkUser($request->ids)){
                    $this->userRepository->destroy_multiple($request->ids);
                    Flash::success('User deleted successfully.');
                }
                else{
                    Flash::error('User not found');
                }
                return redirect(route('admin.users.index'));
            }
            else{
                Flash::error('Chọn mục để xóa!');
                return redirect(route('admin.users.index'));
            }
        }
        else{
            $user = $this->userRepository->findWithoutFail($id);

            if (empty($user)) {
                Flash::error('User not found');

                return redirect(route('admin.users.index'));
            }

            $this->userRepository->delete($id);

            Flash::success('User deleted successfully.');

            return redirect(route('admin.users.index'));
        }

    }

    public function exportExcel(Request $request)
    {
        $type = $request->type;
        $users = $this->userRepository->all();
        $data = $users->toArray();
        if ($type == 'xls') {
            Excel::create('Users', function ($excel) use ($data) {

                $excel->sheet('Sheetname', function ($sheet) use ($data) {

                    $sheet->fromArray($data);

                });

            })->export('xls');
        } elseif ($type == 'csv') {
            Excel::create('Users', function ($excel) use ($data) {

                $excel->sheet('Sheetname', function ($sheet) use ($data) {

                    $sheet->fromArray($data);

                });

            })->export('csv');
        }
    }


    public function action(Request $request){
        $submit_type = $request->submit_type;
        $ids = $request->ids;
        if($submit_type == 'DELETE_MULTI'){
            $this->destroy('MULTI', $request);
        }else{
            if (empty($ids)){
                Flash::warning(__('No value is selected. Check again!'));
                return redirect(route('admin.users.index'));
            }
            if ($submit_type == 'ACTIVE_MULTI'){
                foreach ($ids as $id){
                    $this->activeUser($id);
                }
                return $this->sendResponse($ids, 'User updated successfully');
            }elseif ($submit_type == 'INACTIVE_MULTI'){
                foreach ($ids as $id){
                    $user = $this->userRepository->findWithoutFail($id);
                    $user->active  = 0;
                    $user->save();
                }
                Flash::success('User update active successfully.');
            }
            return $this->sendResponse($ids, 'User updated successfully');
        }
//        return redirect(route('admin.users.index'));

    }

    public function common_action(Request $request){
        $submit_type = $request->submit_type;
        $ids = $request->ids;
        if(strcmp($submit_type.'',"DELETE_MULTI")==0){
            $this->destroy('MULTI', $request);
        }
        elseif(strcmp($submit_type.'',"ACTIVE_MULTI")==0){
            if (empty($ids)){
                Flash::warning(__('No value is selected. Check again!'));
            } else {
                foreach ($ids as $id){
                    $user = $this->userRepository->findWithoutFail($id);
                    $user->active  = 1;
                    $user->save();
                }
                Flash::success('User update active successfully.');
            }
            return redirect(route('admin.users.index'));
        }elseif (strcmp($submit_type.'',"INACTIVE_MULTI")==0){
            if (empty($ids)){
                Flash::warning(__('No value is selected. Check again!'));
            } else {
                foreach ($ids as $id){
                    $user = $this->userRepository->findWithoutFail($id);
                    $user->active  = 0;
                    $user->save();
                }
                Flash::success('User update active successfully.');
            }
        }
        return redirect(route('admin.users.index'));

    }
}


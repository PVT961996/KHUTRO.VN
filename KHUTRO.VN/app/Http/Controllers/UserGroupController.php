<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserGroupRequest;
use App\Http\Requests\UpdateUserGroupRequest;
use App\Repositories\UserGroupRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Repositories\GroupRepository;
use App\Repositories\UserRepository;

class UserGroupController extends AppBaseController
{
    /** @var  UserGroupRepository */
    private $userGroupRepository, $groupRepository;
    private $userRepository;

    public function __construct(UserGroupRepository $userGroupRepo, GroupRepository $groupRepo, UserRepository $userRepo)
    {
        $this->userGroupRepository = $userGroupRepo;
        $this->groupRepository = $groupRepo;
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the UserGroup.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userGroupRepository->pushCriteria(new RequestCriteria($request));
        $userGroups = $this->userGroupRepository->all();
        $groups = $this->groupRepository->all();

        return view('backend.user_groups.index', compact('groups'))
            ->with('userGroups', $userGroups);
    }

    /**
     * Show the form for creating a new UserGroup.
     *
     * @return Response
     */
    public function create()
    {
        $groups = $this->groupRepository->all();
        $users = $this->userRepository->all();
        return view('backend.user_groups.create', compact('groups','users'));
    }

    /**
     * Store a newly created UserGroup in storage.
     *
     * @param CreateUserGroupRequest $request
     *
     * @return Response
     */
    public function store(CreateUserGroupRequest $request)
    {
        $input = $request->all();

        $userGroup = $this->userGroupRepository->create($input);

        Flash::success('User Group saved successfully.');

        return redirect(route('admin.userGroups.index'));
    }

    /**
     * Display the specified UserGroup.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userGroup = $this->userGroupRepository->findWithoutFail($id);

        if (empty($userGroup)) {
            Flash::error('User Group not found');

            return redirect(route('admin.userGroups.index'));
        }

        return view('backend.user_groups.show')->with('userGroup', $userGroup);
    }

    /**
     * Show the form for editing the specified UserGroup.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userGroup = $this->userGroupRepository->findWithoutFail($id);
        $groups = $this->groupRepository->all();
        $users = $this->userRepository->all();
        if (empty($userGroup)) {
            Flash::error('User Group not found');

            return redirect(route('admin.userGroups.index'));
        }

        return view('backend.user_groups.edit',compact('groups','users'))->with('userGroup', $userGroup);
    }

    /**
     * Update the specified UserGroup in storage.
     *
     * @param  int              $id
     * @param UpdateUserGroupRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserGroupRequest $request)
    {
        $userGroup = $this->userGroupRepository->findWithoutFail($id);

        if (empty($userGroup)) {
            Flash::error('User Group not found');

            return redirect(route('admin.userGroups.index'));
        }

        $userGroup = $this->userGroupRepository->update($request->all(), $id);

        Flash::success('User Group updated successfully.');

        return redirect(route('admin.userGroups.index'));
    }

    /**
     * Remove the specified UserGroup from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userGroup = $this->userGroupRepository->findWithoutFail($id);

        if (empty($userGroup)) {
            Flash::error('User Group not found');

            return redirect(route('admin.userGroups.index'));
        }

        $this->userGroupRepository->delete($id);

        Flash::success('User Group deleted successfully.');

        return redirect(route('admin.userGroups.index'));
    }
}

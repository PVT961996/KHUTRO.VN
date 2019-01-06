<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserMenuRequest;
use App\Http\Requests\UpdateUserMenuRequest;
use App\Repositories\ActionRepository;
use App\Repositories\GroupRepository;
use App\Repositories\TableRepository;
use App\Repositories\UserMenuRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserMenuController extends AppBaseController
{
    /** @var  UserMenuRepository */
    private $userMenuRepository;
    private $groupsRepository;
    private $tableRepository;
    private $actionRepository;
    private $userRepository;


    public function __construct(UserMenuRepository $userMenuRepo,GroupRepository $groupRepo, TableRepository $tableRepo, ActionRepository $actionRepo, UserRepository $userRepo)
    {
        $this->userMenuRepository = $userMenuRepo;
        $this->groupsRepository=$groupRepo;
        $this->tableRepository = $tableRepo;
        $this->actionRepository = $actionRepo;
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the UserMenu.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $userMenus = $this->userMenuRepository->all();
        $user_menu_locations = [];
        foreach ($userMenus as $userMenu){
            $user_id = $userMenu->user_id;
            $table_id = $userMenu->menu->table_id;
            $action_id = $userMenu->menu->action_id;
            $user_menu_location = $user_id.'-'.$table_id.'-'.$action_id;
            array_push($user_menu_locations, $user_menu_location);
        }
        $search=$request->search;
        if(!empty($search)){
            if(!empty($search['name'])){
                $users=$this->userRepository->findByField('name','LIKE','%'.$search['name'].'%',['*'],false);
            }
            else{
                $users = $this->userRepository->all();
            }

            if(!empty($search['table'])){
                $tables = $this->tableRepository->findByField('name','LIKE','%'.$search['table'].'%',['*'],false);
            }
            else{
                $tables = $this->tableRepository->all();
            }
        }
        else{
            $this->userMenuRepository->pushCriteria(new RequestCriteria($request));
            $tables = $this->tableRepository->all();
            $users = $this->userRepository->all();
        }
        return view('backend.user_menus.index',compact('tables','users','user_menu_locations'));
    }


    /**
     * Show the form for creating a new UserMenu.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.user_menus.create');
    }

    /**
     * Store a newly created UserMenu in storage.
     *
     * @param CreateUserMenuRequest $request
     *
     * @return Response
     */
    public function store(CreateUserMenuRequest $request)
    {
        $input = $request->all();

        $userMenu = $this->userMenuRepository->create($input);

        Flash::success('User Menu saved successfully.');

        return redirect(route('admin.userMenus.index'));
    }

    /**
     * Display the specified UserMenu.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userMenu = $this->userMenuRepository->findWithoutFail($id);

        if (empty($userMenu)) {
            Flash::error('User Menu not found');

            return redirect(route('admin.userMenus.index'));
        }

        return view('backend.user_menus.show')->with('userMenu', $userMenu);
    }

    /**
     * Show the form for editing the specified UserMenu.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userMenu = $this->userMenuRepository->findWithoutFail($id);

        if (empty($userMenu)) {
            Flash::error('User Menu not found');

            return redirect(route('admin.userMenus.index'));
        }

        return view('backend.user_menus.edit')->with('userMenu', $userMenu);
    }

    /**
     * Update the specified UserMenu in storage.
     *
     * @param  int              $id
     * @param UpdateUserMenuRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserMenuRequest $request)
    {
        $userMenu = $this->userMenuRepository->findWithoutFail($id);

        if (empty($userMenu)) {
            Flash::error('User Menu not found');

            return redirect(route('admin.userMenus.index'));
        }

        $userMenu = $this->userMenuRepository->update($request->all(), $id);

        Flash::success('User Menu updated successfully.');

        return redirect(route('admin.userMenus.index'));
    }

    /**
     * Remove the specified UserMenu from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userMenu = $this->userMenuRepository->findWithoutFail($id);

        if (empty($userMenu)) {
            Flash::error('User Menu not found');

            return redirect(route('admin.userMenus.index'));
        }

        $this->userMenuRepository->delete($id);

        Flash::success('User Menu deleted successfully.');

        return redirect(route('admin.userMenus.index'));
    }
}

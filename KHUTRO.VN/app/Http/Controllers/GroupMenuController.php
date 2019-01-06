<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupMenuRequest;
use App\Http\Requests\UpdateGroupMenuRequest;
use App\Repositories\GroupMenuRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Repositories\TableRepository;
use App\Repositories\GroupRepository;
use App\Repositories\ActionRepository;
use App\Repositories\MenuRepository;


class GroupMenuController extends AppBaseController
{
    /** @var  GroupMenuRepository */
    private $groupMenuRepository;
    private $tableRepository;
    private $actionRepository;
    private $menuRepository;

    public function __construct(GroupMenuRepository $groupMenuRepo, TableRepository $tableRepo,GroupRepository $groupRepo, ActionRepository $actionRepo, MenuRepository $menuRepo)
    {
        $this->groupMenuRepository = $groupMenuRepo;
        $this->tableRepository = $tableRepo;
        $this->groupRepository = $groupRepo;
        $this->actionRepository = $actionRepo;
        $this->menuRepository = $menuRepo;

    }

    /**
     * Display a listing of the GroupMenu.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->groupMenuRepository->pushCriteria(new RequestCriteria($request));

        $groupMenus = $this->groupMenuRepository->all();
        $tables = $this->tableRepository->all();
        $groups = $this->groupRepository->all();
        $actions = $this->actionRepository->all();

        $groups_with_checkall = [];
        $actions_number = 0;
        foreach ($tables as $table){
            $actions_number += count($table->actions()->get());
        }
        foreach ($groups as $group){
            if(count($this->groupMenuRepository->findWhere([['group_id', '=', $group->id]], ['*'],false)) == $actions_number){
                array_push($groups_with_checkall, $group->id);
            }
        }

        $tables_with_checkall = [];
        foreach ($tables as $table){
            $menus = $this->menuRepository->findWhere([['table_id', '=', $table->id]], ['*'],false);
            $menus_in_group_menu_table = 0;
            foreach ($menus as $menu){
                $menus_in_group_menu_table += count($this->groupMenuRepository->findWhere([['menu_id', '=', $menu->id]], ['*'],false));
            }
            $checkall_number = count($groups) * count($table->actions()->get());
            if ($menus_in_group_menu_table == $checkall_number){
                array_push($tables_with_checkall, $table->id);
            }
        }

        $actions_tables_with_checkall = [];
        foreach ($tables as $table){
            foreach ($actions as $action){
                $menus = $this->menuRepository->findWhere([['table_id', '=', $table->id], ['action_id', '=', $action->id]], ['*'],false);
                foreach ($menus as $menu){
                    if(count($this->groupMenuRepository->findWhere([['menu_id', '=', $menu->id]],['*'],false)) == count($groups)){
                        array_push($actions_tables_with_checkall, $table->id.'-'.$action->id);
                    }
                }
            }
        }

        $group_menu_locations = [];
        foreach ($groupMenus as $groupMenu){
            $group_id = $groupMenu->group_id;
            $table_id = $groupMenu->menu()->get()->pluck('table_id')->toArray()[0];
            $action_id = $groupMenu->menu()->get()->pluck('action_id')->toArray()[0];
            $group_menu_location = $group_id.'-'.$table_id.'-'.$action_id;
            array_push($group_menu_locations, $group_menu_location);
        }

        return view('backend.group_menus.index', compact('tables','groups', 'group_menu_locations','groups_with_checkall', 'actions_tables_with_checkall', 'tables_with_checkall'))
            ->with('groupMenus', $groupMenus);
    }

    /**
     * Show the form for creating a new GroupMenu.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.group_menus.create');
    }

    /**
     * Store a newly created GroupMenu in storage.
     *
     * @param CreateGroupMenuRequest $request
     *
     * @return Response
     */
    public function store(CreateGroupMenuRequest $request)
    {
        $input = $request->all();

        $groupMenu = $this->groupMenuRepository->create($input);

        Flash::success('Group Menu saved successfully.');

        return redirect(route('admin.groupMenus.index'));
    }

    /**
     * Display the specified GroupMenu.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $groupMenu = $this->groupMenuRepository->findWithoutFail($id);

        if (empty($groupMenu)) {
            Flash::error('Group Menu not found');

            return redirect(route('admin.groupMenus.index'));
        }

        return view('backend.group_menus.show')->with('groupMenu', $groupMenu);
    }

    /**
     * Show the form for editing the specified GroupMenu.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $groupMenu = $this->groupMenuRepository->findWithoutFail($id);

        if (empty($groupMenu)) {
            Flash::error('Group Menu not found');

            return redirect(route('admin.groupMenus.index'));
        }

        return view('backend.group_menus.edit')->with('groupMenu', $groupMenu);
    }

    /**
     * Update the specified GroupMenu in storage.
     *
     * @param  int              $id
     * @param UpdateGroupMenuRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGroupMenuRequest $request)
    {
        $groupMenu = $this->groupMenuRepository->findWithoutFail($id);

        if (empty($groupMenu)) {
            Flash::error('Group Menu not found');

            return redirect(route('admin.groupMenus.index'));
        }

        $groupMenu = $this->groupMenuRepository->update($request->all(), $id);

        Flash::success('Group Menu updated successfully.');

        return redirect(route('admin.groupMenus.index'));
    }

    /**
     * Remove the specified GroupMenu from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $groupMenu = $this->groupMenuRepository->findWithoutFail($id);

        if (empty($groupMenu)) {
            Flash::error('Group Menu not found');

            return redirect(route('admin.groupMenus.index'));
        }

        $this->groupMenuRepository->delete($id);

        Flash::success('Group Menu deleted successfully.');

        return redirect(route('admin.groupMenus.index'));
    }
}

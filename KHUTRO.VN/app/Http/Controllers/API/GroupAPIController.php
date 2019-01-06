<?php

namespace App\Http\Controllers\API;


use App\Models\Group;
use App\Models\GroupMenu;
use App\Repositories\GroupRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Repositories\MenuRepository;
use App\Repositories\GroupMenuRepository;



/**
 * Class BannerController
 * @package App\Http\Controllers\API
 */
class GroupAPIController extends AppBaseController
{
    /** @var  ActionRepository */
    private $groupRepository;
    private $menuRepository;
    private $groupMenuRepository;

    public function __construct(GroupRepository $groupRepo, MenuRepository $menuRepo, GroupMenuRepository $groupMenuRepo)
    {
        $this->groupRepository = $groupRepo;
        $this->menuRepository = $menuRepo;
        $this->groupMenuRepository = $groupMenuRepo;

    }

    public function updateActiveAttribute($id)
    {
        /** @var Banner $banner */
        $group = $this->groupRepository->findWithoutFail($id);

        if (empty($group)) {
            return $this->sendError('Action not found');
        }

        if ($group->active) {
            $group->active = 0;
        } else {
            $group->active = 1;
        }

        $group->save();

        return $this->sendResponse($group->toArray(), 'Action updated successfully');
    }

    public function syncGroupMenuRelation(Request $request)
    {
        $groupId = $request->group_id;
        $group = $this->groupRepository->findWithoutFail($groupId);
        if ($request->action == 'ADD_SINGLE') {
            $tableId = $request->table_id;
            $actionId = $request->action_id;

            $menu = $this->menuRepository->findWhere([['table_id', '=', $tableId], ['action_id', '=', $actionId]], ['*'])->first();

            $this->group_menu_create($group, $menu);
        } elseif ($request->action == 'REMOVE_SINGLE'){

            $tableId = $request->table_id;
            $actionId = $request->action_id;

            $menu = $this->menuRepository->findWhere([['table_id', '=', $tableId], ['action_id', '=', $actionId]], ['*'])->first();
            $group_menu_id = $this->groupMenuRepository->findWhere([['group_id', '=', $groupId], ['menu_id', '=', $menu->id]])->first()->id;

            $this->groupMenuRepository->delete($group_menu_id);
        } elseif ($request->action == 'ACTION_CHECK_ALL'){

            $tableId = $request->table_id;
            $actionId = $request->action_id;

            $menu = $this->menuRepository->findWhere([['table_id', '=', $tableId], ['action_id', '=', $actionId]], ['*'])->first();
            $groups = $this->groupRepository->all();

            foreach ($groups as $group){
                $this->group_menu_create($group, $menu);
            }
        } elseif ($request->action == 'ACTION_UNCHECK_ALL'){

            $tableId = $request->table_id;
            $actionId = $request->action_id;

            $menu = $this->menuRepository->findWhere([['table_id', '=', $tableId], ['action_id', '=', $actionId]], ['*'])->first();

            $this->groupMenuRepository->deleteWhere([['menu_id', '=', $menu->id]]);
        } elseif ($request->action == 'GROUP_CHECK_ALL'){
            $group = $this->groupRepository->find($groupId);
            $menus = $this->menuRepository->all();

            foreach ($menus as $menu){
                $this->group_menu_create($group, $menu);
            }
        } elseif ($request->action == 'GROUP_UNCHECK_ALL'){

            $group = $this->groupRepository->find($groupId);

            $this->groupMenuRepository->deleteWhere([['group_id', '=', $group->id]]);
        } elseif ($request->action == 'TABLE_CHECK_ALL'){
            $tableId = $request->table_id;

            $menus = $this->menuRepository->findWhere([['table_id', '=', $tableId]], ['*']);
            $groups = $this->groupRepository->all();

            foreach ($menus as $menu){
                foreach ($groups as $group){
                    $this->group_menu_create($group, $menu);
                }
            }
        } elseif ($request->action == 'TABLE_UNCHECK_ALL'){

            $tableId = $request->table_id;

            $menus = $this->menuRepository->findWhere([['table_id', '=', $tableId]], ['*']);

            foreach ($menus as $menu){
                $this->groupMenuRepository->deleteWhere([['menu_id', '=', $menu->id]]);
            }
        }
    }

    public function group_menu_create($group, $menu){
        $group_menus = $this->groupMenuRepository->findWhere([['group_id', '=', $group->id], ['menu_id', '=', $menu->id]], ['*']);
        if(count($group_menus) == 0){
            $group_menu = new GroupMenu();
            $group_menu->group_id = $group->id;
            $group_menu->menu_id = $menu->id;
            $group_menu->save();
        }
    }
}

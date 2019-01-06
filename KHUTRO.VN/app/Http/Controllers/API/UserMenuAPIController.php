<?php

namespace App\Http\Controllers\API;


use App\Models\Action;
use App\Models\UserMenu;
use App\Repositories\GroupMenuRepository;
use App\Repositories\MenuRepository;
use App\Repositories\UserMenuRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BannerController
 * @package App\Http\Controllers\API
 */

class UserMenuAPIController extends AppBaseController
{
    /** @var  ActionRepository */
    private $userMenuRepository;
    private $menuRepository;
    private $userRepository;
    public function __construct(UserMenuRepository $userMenuRepo,MenuRepository $menuRepo,UserRepository $userRepo)
    {
        $this->userMenuRepository = $userMenuRepo;
        $this->menuRepository=$menuRepo;
        $this->userRepository=$userRepo;
    }

    public function syncUserMenuRelation(Request $request){
        if($request->action == 'ADD-TABLE'){
            $tableId = $request->table_id;
            $menus = $this->menuRepository->findWhere([['table_id', '=', $tableId]], ['*']);
            $users = $this->userRepository->all();

            foreach ($menus as $menu){
                foreach ($users as $user){
                    $this->user_menu_create($user, $menu);
                }
            }
        }
        elseif ($request->action == 'REMOVE-TABLE'){
            $tableId = $request->table_id;
            $menus = $this->menuRepository->findWhere([['table_id', '=', $tableId]], ['*']);

            foreach ($menus as $menu){
                $this->userMenuRepository->deleteWhere([['menu_id', '=', $menu->id]]);
            }
        }
        elseif ($request->action == 'ADD-TABLE-ACTION'){
            $tableId = $request->table_id;
            $actionId = $request->action_id;

            $menu = $this->menuRepository->findWhere([['table_id', '=', $tableId], ['action_id', '=', $actionId]], ['*'])->first();
            $users = $this->userRepository->all();

            foreach ($users as $user){
                $this->user_menu_create($user, $menu);
            }
        }
        elseif ($request->action == 'REMOVE-TABLE-ACTION'){
            $tableId = $request->table_id;
            $actionId = $request->action_id;
            $menu = $this->menuRepository->findWhere([['table_id', '=', $tableId], ['action_id', '=', $actionId]], ['*'])->first();
            $this->userMenuRepository->deleteWhere([['menu_id', '=', $menu->id]]);
        }
        elseif ($request->action == 'ADD-USER'){
            $userId = $request->user_id;
            $user = $this->userRepository->find($userId);
            $menus = $this->menuRepository->all();

            foreach ($menus as $menu){
                $this->user_menu_create($user, $menu);
            }
        }
        elseif ($request->action == 'REMOVE-USER'){
            $userId = $request->user_id;
            $user = $this->userRepository->find($userId);
            $this->userMenuRepository->deleteWhere([['user_id', '=', $user->id]]);
        }
        elseif ($request->action == 'ADD-ALL'){
            $menus=$this->menuRepository->all();
            $users = $this->userRepository->all();
            foreach ($users as $user){
                foreach ($menus as $menu){
                    $this->user_menu_create($user, $menu);
                }
            }
        }
        elseif ($request->action == 'REMOVE-ALL'){
            $user_menus = $this->userMenuRepository->all(['id']);
            $ids=[];
            foreach ($user_menus as $user_menu){
                $ids[]=$user_menu->id;
            }
            $this->userMenuRepository->destroy_multiple($ids);

        }
        else{
            $userId = $request->user_id;
            $tableId = $request->table_id;
            $actionId = $request->action_id;
            $menu = $this->menuRepository->findWhere([['table_id', '=', $tableId], ['action_id', '=', $actionId]], ['*'])->first();
            if ($request->action == 'ADD') {
                $user_menu = $this->userMenuRepository->create(['user_id'=>$userId,'menu_id'=>$menu->id]);
            } else{
                $user_menu_id = $this->userMenuRepository->findWhere([['user_id', '=', $userId], ['menu_id', '=', $menu->id]])->first()->id;
                $this->userMenuRepository->delete($user_menu_id);
            }
        }
        return $this->sendResponse(['abc'=>'ok'], 'ok');
    }

    public function user_menu_create($user, $menu){
        $user_menus = $this->userMenuRepository->findWhere([['user_id', '=', $user->id], ['menu_id', '=', $menu->id]], ['*']);
        if(count($user_menus) == 0){
            $user_menu = new UserMenu();
            $user_menu->user_id = $user->id;
            $user_menu->menu_id = $menu->id;
            $user_menu->save();
        }
    }
}

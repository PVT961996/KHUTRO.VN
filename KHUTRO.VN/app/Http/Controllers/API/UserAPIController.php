<?php

namespace App\Http\Controllers\API;


use App\Models\Action;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BannerController
 * @package App\Http\Controllers\API
 */

class UserAPIController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }


    public function actives($id)
    {
        $user = $this->userRepository->findWithoutFail($id);
        if (empty($user)) {
            return $this->sendError('User not found');
        }
        if($user->active){
            $user->active  = 0;
        }else{
            $user->active  = 1;
        }
        $user->save();

        return $this->sendResponse($user->toArray(), 'User updated successfully');
    }
}

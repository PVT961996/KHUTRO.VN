<?php

namespace App\Http\Controllers\API;


use App\Models\Action;
use App\Repositories\ActionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BannerController
 * @package App\Http\Controllers\API
 */

class ActionAPIController extends AppBaseController
{
    /** @var  ActionRepository */
    private $actionRepository;

    public function __construct(ActionRepository $actionRepo)
    {
        $this->actionRepository = $actionRepo;
    }

    public function updateActiveAttribute($id)
    {
        /** @var Banner $banner */
        $action = $this->actionRepository->findWithoutFail($id);

        if (empty($action)) {
            return $this->sendError('Action not found');
        }

        if($action->active){
            $action->active  = 0;
        }else{
            $action->active  = 1;
        }

        $action->save();

        return $this->sendResponse($action->toArray(), 'Action updated successfully');
    }
}

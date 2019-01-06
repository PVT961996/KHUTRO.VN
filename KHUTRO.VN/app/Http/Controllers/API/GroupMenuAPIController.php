<?php

namespace App\Http\Controllers\API;


use App\Models\Action;
use App\Repositories\GroupMenuRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BannerController
 * @package App\Http\Controllers\API
 */

class GroupMenuAPIController extends AppBaseController
{
    /** @var  ActionRepository */
    private $groupMenuReposioty;

    public function __construct(GroupMenuRepository $groupMenuRepo)
    {
        $this->groupMenuReposioty = $groupMenuRepo;
    }
}

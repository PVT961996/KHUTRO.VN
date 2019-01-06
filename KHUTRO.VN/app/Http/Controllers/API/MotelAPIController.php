<?php

namespace App\Http\Controllers\API;

use App\Repositories\ConfigMotelCategoryRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\PostRepository;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Repositories\MotelRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\StreetRepository;
use App\Repositories\TownRepository;
use Illuminate\Http\Request;


class MotelAPIController extends AppBaseController
{
    private $motelRepository;
    private $proviceRepository;
    private $districtRepository;
    private $townRepository;
    private $streetRepository;
    private $configMotelCategoryRepository;

    public function __construct(ConfigMotelCategoryRepository $configMotelCategoryRepo,MotelRepository $motelRepo, ProvinceRepository $provinceRepo, DistrictRepository $districtRepo, TownRepository $townRepo, StreetRepository $streetRepo)
    {
        $this->motelRepository = $motelRepo;
        $this->proviceRepository = $provinceRepo;
        $this->districtRepository = $districtRepo;
        $this->townRepository = $townRepo;
        $this->streetRepository = $streetRepo;
        $this->configMotelCategoryRepository = $configMotelCategoryRepo;
    }



    public function getDistrict($provinceId){
        $districts = $this->districtRepository->findByField('province_id','=',$provinceId,['*'],false);
        return $this->sendResponse($districts->toArray(), '');
    }
    public function getTown($districtId){
        $towns = $this->townRepository->findByField('district_id','=',$districtId,['*'],false);
        return $this->sendResponse($towns->toArray(), '');
    }
    public function getStreet($townId){
        $streets = $this->streetRepository->findByField('town_id','=',$townId,['*'],false);
        return $this->sendResponse($streets->toArray(), '');
    }



    /*          getFieldsConfigCategory trả về 1 view được định dạng như trong bd
     * 1: checkbox có thể chọn được nhiều
     * 2: checkbox chỉ cho phép chọn 1
     * 3: selectbox
     * 4: inputNumber
     * 5: inputText
     * 6: inputDateTime
     * */

    public function getFieldsConfigCategory($categoryId){
        $fieldsConfigCategory = $this->configMotelCategoryRepository->findByField('motel_category_id','=',$categoryId,['*'],false);
        $viewResult = [];
        foreach ($fieldsConfigCategory as $fieldConfigCategory){
            $htmlType = $fieldConfigCategory->html_type;
            switch ($htmlType) {
                case '1':
                    $options = explode (":",$fieldConfigCategory->default_value);
                    $html = view('common.checkboxMultip',compact('options'))->with('fieldConfigCategory',$fieldConfigCategory)->render();
                    break;
                case '2':
                    $options = explode (":",$fieldConfigCategory->default_value);
                    $html = view('common.checkboxOnlySelectOne',compact('options'))->with('fieldConfigCategory',$fieldConfigCategory)->render();
                    break;
                case '3':
                    break;
                case '4':
                    break;
                case '5':
                    $html = view('common.inputText')->with('fieldConfigCategory',$fieldConfigCategory)->render();
                    break;
            }
            $viewResult[]=$html;
        }
        return $this->sendResponse($viewResult, '');
    }

    public function actives($id)
    {
        $motel = $this->motelRepository->findWithoutFail($id);
        if (empty($motel)) {
            return $this->sendError('Motel not found');
        }
        if($motel->status){
            $motel->status  = 0;
        }else{
            $motel->status  = 1;
        }
        $motel->save();

        return $this->sendResponse($motel->toArray(), 'Motel updated successfully');
    }
}

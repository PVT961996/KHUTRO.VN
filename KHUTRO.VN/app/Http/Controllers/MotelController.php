<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMotelRequest;
use App\Http\Requests\UpdateMotelRequest;
use App\Models\ValueConfigMotel;
use App\Repositories\ConfigMotelCategoryRepository;
use App\Repositories\ConfigPriceRepository;
use App\Repositories\DeviceMotelRepository;
use App\Repositories\DeviceRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\MotelCategoryRepository;
use App\Repositories\MotelRepository;
use App\Repositories\MotelSaveRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\RoomRepository;
use App\Repositories\SeviceMotelRepository;
use App\Repositories\SeviceRepository;
use App\Repositories\StreetRepository;
use App\Repositories\TownRepository;
use App\Repositories\ValueConfigMotelRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class MotelController extends AppBaseController
{
    /** @var  MotelRepository */
    private $motelRepository;
    private $motelCategoryRepository;
    private $configPriceRepository;
    private $proviceRepository;
    private $districtRepository;
    private $townRepository;
    private $streetRepository;
    private $deviceRepository;
    private $configMotelCategoryRepository;
    private $valueConfigMotelRepository;
    private $seviceRepository;
    private $deviceMotelRepository;
    private $seviceMotelRepository;
    private $roomRepository;
    private $motelSaveRepository;

    private $motelVie = "Bất Động Sản";

    public function __construct(MotelSaveRepository $motelSaveRepo,RoomRepository $roomRepo,DeviceMotelRepository $deviceMotelRepo,SeviceMotelRepository $seviceMotelRepo,SeviceRepository $seviceRepo,ValueConfigMotelRepository $valueConfigMotelRepo,ConfigMotelCategoryRepository $configMotelCategoryRepo, DeviceRepository $deviceRepo, MotelRepository $motelRepo, MotelCategoryRepository $motelCategoryRepo, ConfigPriceRepository $configPriceRepo, ProvinceRepository $provinceRepo, DistrictRepository $districtRepo, TownRepository $townRepo, StreetRepository $streetRepo)
    {
        $this->motelSaveRepository = $motelSaveRepo;
        $this->roomRepository = $roomRepo;
        $this->deviceMotelRepository = $deviceMotelRepo;
        $this->seviceMotelRepository = $seviceMotelRepo;
        $this->seviceRepository = $seviceRepo;
        $this->motelRepository = $motelRepo;
        $this->motelCategoryRepository = $motelCategoryRepo;
        $this->configPriceRepository = $configPriceRepo;
        $this->proviceRepository = $provinceRepo;
        $this->districtRepository = $districtRepo;
        $this->townRepository = $townRepo;
        $this->streetRepository = $streetRepo;
        $this->deviceRepository = $deviceRepo;
        $this->configMotelCategoryRepository = $configMotelCategoryRepo;
        $this->valueConfigMotelRepository = $valueConfigMotelRepo;
    }

    /**
     * Display a listing of the Motel.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search=$request->search;
        $motelCategories = $this->motelCategoryRepository->all();
        $selectBoxCategory = [0=>'-----Chọn danh mục ('.count($motelCategories).')-----'];
        foreach ($motelCategories as $category){
            $selectBoxCategory[$category->id]=$category->name;
        }
        if(!empty($search['title']&&$search['category']=='0'&&empty($search['user']))){
            $motels = $this->motelCategoryRepository->findByField('title','LIKE','%'.$search['title'].'%',['*'],true,10);
            return view('backend.motels.index',compact('selectBoxCategory'))
                ->with('motels', $motels);
        }

        $searchCondition = [];

        if(!empty($search)){
            $u=null; $c='0'; $title = '';
            if(!empty($search['title'])){
                array_push($searchCondition,['title','LIKE','%'.$search['title'].'%']);
            }
            if(!empty($search['user'])){
                $u = $search['user'];
            }
            if(($search['category']!='0')){
                $c = $search['category'];
            }
            if($u==null&&$c=='0'&&$title==''){
                $motels = $this->motelRepository->paginate(10);
                return view('backend.motels.index',compact('selectBoxCategory'))
                    ->with('motels', $motels);
            }
            $motels = $this->motelRepository->search($searchCondition,true,10,$u,$c);

        }
        else{
            $motels = $this->motelRepository->paginate(10);
        }

        return view('backend.motels.index',compact('selectBoxCategory'))
            ->with('motels', $motels);
    }


    /*          getFieldsConfigCategory trả về 1 mảng các trường được định dạng như trong bd của một danh mục BDS(motel)
            Các case support trong trường html_type
     * case 1: checkbox có thể chọn được nhiều
     * case 2: checkbox chỉ cho phép chọn 1
     * case 3: selectbox
     * case 4: inputNumber
     * case 5: inputText
     * case 6: inputDateTime
     * */
    public function getFieldsConfigCategory($categoryId,$motel=null){
        $fieldsConfigCategory = $this->configMotelCategoryRepository->findByField('motel_category_id','=',$categoryId,['*'],false);
        $viewResult = [];
        foreach ($fieldsConfigCategory as $fieldConfigCategory){
            $htmlType = $fieldConfigCategory->html_type;
            $options = explode (":",$fieldConfigCategory->default_value);
            $values=[];
            if($motel!=null){
                $valueConfigMotels = $this->valueConfigMotelRepository->findWhere([['config_category_id','=',$fieldConfigCategory->id],['motel_id','=',$motel->id]],['*'],false);
                foreach ($valueConfigMotels as $value){
                    $values[] = $value->value;
                }
            }
            switch ($htmlType) {
                case '1':
                    if($motel!=null){
                        $valuesCheckboxMultip=$values;
                        $html = view('common.checkboxMultip',compact('options','valuesCheckboxMultip'))->with('fieldConfigCategory',$fieldConfigCategory)->render();
                    }
                    else{
                        $html = view('common.checkboxMultip',compact('options'))->with('fieldConfigCategory',$fieldConfigCategory)->render();
                    }
                    break;
                case '2':
                    if($motel!=null){
                        $valuesCheckboxOnlySelectOne=$values;
                        $html = view('common.checkboxOnlySelectOne',compact('options','valuesCheckboxOnlySelectOne'))->with('fieldConfigCategory',$fieldConfigCategory)->render();
                    }
                    else{
                        $html = view('common.checkboxOnlySelectOne',compact('options'))->with('fieldConfigCategory',$fieldConfigCategory)->render();
                    }
                    break;
                case '3':
                    if($motel!=null){
                        $valueSelectBox=$values;
                        $html = view('common.selectBox',compact('options','valueSelectBox'))->with('fieldConfigCategory',$fieldConfigCategory)->render();
                    }
                    else{
                        $html = view('common.selectBox',compact('options'))->with('fieldConfigCategory',$fieldConfigCategory)->render();
                    }
                    break;
                case '4':
                    if($motel!=null){
                        $valueInputNumber=$values;
                        $html = view('common.inputNumber',compact('valueInputNumber'))->with('fieldConfigCategory',$fieldConfigCategory)->render();
                    }
                    else{
                        $html = view('common.inputNumber')->with('fieldConfigCategory',$fieldConfigCategory)->render();
                    }
                    break;
                case '5':
                    if($motel!=null){
                        $valueInputText=$values;
                        $html = view('common.inputText',compact('valueInputText'))->with('fieldConfigCategory',$fieldConfigCategory)->render();
                    }
                    else{
                        $html = view('common.inputText')->with('fieldConfigCategory',$fieldConfigCategory)->render();
                    }
                    break;
            }
            $viewResult[$fieldConfigCategory->field_name.'-'.$htmlType]=$html;
        }
        return $viewResult;
    }


    public function create()
    {
        $motelCategories = $this->motelCategoryRepository->all();
        /*      $fieldsConfig:
         * Mảng chứa các viewFields: Chứa tất cả các trường của từng danh mục:
            -- key : id của danh mục
            -- value: mảng chứa các trường cấu hình
         * */
        $fieldsConfig=[];
        $configHtml = [];
        foreach ($motelCategories as $motelCategory){
            $infosConfig = $this->getFieldsConfigCategory($motelCategory->id);
            $fieldsConfig[$motelCategory->id] =$infosConfig;
            foreach ($infosConfig as $info=>$value){
                $html_type = explode ("-",$info)[1];
                if(!empty($configHtml[$html_type])){
                    $configHtml[$html_type] = $configHtml[$html_type].'&'.$info;
                }
                else{
                    $configHtml[$html_type]=$info;
                }
            }
        }

        $configPrices = $this->configPriceRepository->all();
        foreach ($configPrices as $configPrice){
            $selectBoxTypePrice[$configPrice->id] = $configPrice->name;
        }
        $selectBoxConfigPrice[1] = 'Đơn Giá';
        $selectBoxConfigPrice[2] = 'Khoảng Giá';

        $provinces = $this->proviceRepository->orderBy('name','asc')->all();
        $devices = $this->deviceRepository->orderBy('order','asc')->all();
        $sevices = $this->seviceRepository->orderBy('order','asc')->all();
        foreach ($provinces as $province){
            $selectBoxProvince[$province->id] = $province->name;
        }
        return view('backend.motels.create',compact('configHtml','fieldsConfig','devices','sevices','configPrices','provinces','motelCategories','selectBoxConfigPrice','selectBoxTypePrice','selectBoxProvince'));
    }

    /**
     * Store a newly created Motel in storage.
     *
     * @param CreateMotelRequest $request
     *
     * @return Response
     */
    public function store(CreateMotelRequest $request)
    {
        $input = $request->all();

        dd($request);
        if($request->category_ids){
            $input['motel_category_id']=$input['category_ids'][0];
        }
        else{
            Flash::error(__('messages.do_not_select_motel_category'));
            return back()->withInput();
        }
        $configPrice = $input['selectBoxTypePrice']['configPrice'];
        $input['config_price_id'] = $configPrice;
        if($request->selectBoxPrice[0]=='1'){
            $input['min_price'] = $request->price;
            $input['max_price'] = $request->price;
        }
        if($request->province_id=='-1'){
            $input['province_id']=null;
        }
        if($request->district_id=='-1'){
            $input['district_id']=null;
        }
        if($request->town_id=='-1'){
            $input['town_id']=null;
        }
        if($request->street_id=='-1'){
            $input['street_id']=null;
        }
        $input['user_id'] = Auth::id();
        if (!empty($input['image_title'])) {
            $imageName = time().'.'.transText($request->image_title->getClientOriginalName(),'-');
            $request->image_title->move(public_path('uploads/motels'), $imageName);
            $request->image_title = $imageName;
            $input['image_title'] = '/uploads/motels/'.$imageName;
        }
        $input['status']=0;
        $motel = $this->motelRepository->create($input);

        /*Đồng bộ với thiết bị*/
        $device_ids = $request->devices;
        $motel->devices()->sync($device_ids);
        /*Đồng bộ với dịch vụ*/
        $sevice_ids = $request->sevices;
        $motel->sevices()->sync($sevice_ids);


        $fieldsConfig = $request->fields;
        foreach ($fieldsConfig as $fieldName=>$fieldConfig){
            if($fieldConfig){
                $valueConfig='';
                if(is_array($fieldConfig)){
                    foreach($fieldConfig as $field){
                        if($valueConfig==''){
                            $valueConfig = $field;
                        }
                        else{
                            $valueConfig .= ':'.$field;
                        }
                    }
                }
                else{
                    $valueConfig = $fieldConfig;
                }
                $config_motel_category = $this->configMotelCategoryRepository->findByField('field_name','=',$fieldName,['*'],false)->first();
                $valueConfigMotel = new ValueConfigMotel();
                $valueConfigMotel->config_category_id = $config_motel_category->id;
                $valueConfigMotel->value = $valueConfig;
                $valueConfigMotel->motel_id = $motel->id;
                $valueConfigMotel->save();
            }
        }

        Flash::success(__('messages.motel_saved'));
        if($input['save']==='save_edit'){
            return redirect(route('admin.motels.edit', $motel->id));
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.motels.create'));
        }
        else{
            return redirect(route('admin.motels.index'));
        }

    }

    /**
     * Display the specified Motel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $motel = $this->motelRepository->findWithoutFail($id);

        if (empty($motel)) {
            Flash::error(__('messages.motel_not_found'));

            return redirect(route('admin.motels.index'));
        }

        return view('backend.motels.show')->with('motel', $motel);
    }

    /**
     * Show the form for editing the specified Motel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $motel = $this->motelRepository->findWithoutFail($id);

        if (empty($motel)) {
            Flash::error(__("messages.motel_not_found"));
            return redirect(route('admin.motels.index'));
        }
//        dd($motel->image_title);
        /*Danh muc BDS*/
        $current_category_id = $motel->motelCategory->id;
        $motelCategories = $this->motelCategoryRepository->all();

        /*Thiet Bi Dich Vu BDS*/
        $devices = $this->deviceRepository->orderBy('order','asc')->all();
        $sevices = $this->seviceRepository->orderBy('order','asc')->all();

        $current_devices = $motel->devices;
        $current_sevices = $motel->sevices;

        $configPrices = $this->configPriceRepository->all();

        /*      $fieldsConfig:
         * Mảng chứa các viewFields: Chứa tất cả các trường của từng danh mục:
            -- key : id của danh mục
            -- value: mảng chứa các trường cấu hình
         * */
        $fieldsConfig=[];
        $configHtml = [];
        foreach ($motelCategories as $motelCategory){
            $infosConfig = $this->getFieldsConfigCategory($motelCategory->id,$motel);
            $fieldsConfig[$motelCategory->id] =$infosConfig;
            foreach ($infosConfig as $info=>$value){
                $html_type = explode ("-",$info)[1];
                if(!empty($configHtml[$html_type])){
                    $configHtml[$html_type] = $configHtml[$html_type].'&'.$info;
                }
                else{
                    $configHtml[$html_type]=$info;
                }
            }
        }

        foreach ($configPrices as $configPrice){
            $selectBoxTypePrice[$configPrice->id] = $configPrice->name;
        }
        $selectBoxConfigPrice[1] = 'Đơn Giá';
        $selectBoxConfigPrice[2] = 'Khoảng Giá';

        /* Dia chi */
        $provinces = $this->proviceRepository->orderBy('name','asc')->all();

        foreach ($provinces as $province){
            $selectBoxProvince[$province->id] = $province->name;
        }


        return view('backend.motels.edit',compact('districts','towms','streets','current_sevices','current_devices','current_category_id','configHtml','fieldsConfig','devices','sevices','configPrices','provinces','motelCategories','selectBoxConfigPrice','selectBoxTypePrice','selectBoxProvince'))->with('motel', $motel);

    }

    /**
     * Update the specified Motel in storage.
     *
     * @param  int              $id
     * @param UpdateMotelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMotelRequest $request)
    {

        $motel = $this->motelRepository->findWithoutFail($id);
        if (empty($motel)) {
            Flash::error(__("messages.motel_not_found"));

            return redirect(route('admin.motels.index'));
        }
        $input = $request->all();

        if($request->category_ids){
            // Nếu chọn danh mục khác. Mọi thông tin trong bảng giá trị cấu hình bị xóa bỏ.
            if($input['category_ids'][0]!=$motel->motelCategory->id){

                $valuesDelete = $this->valueConfigMotelRepository->findByField('motel_id','=',$motel->id,['*'],false);
                $ids=[];
                foreach ($valuesDelete as $value){
                    $ids[] = $value->id;
                }
                $this->valueConfigMotelRepository->destroy_multiple($ids);
                $input['motel_category_id']=$input['category_ids'][0];
            }
        }
        else{
            Flash::error(__('messages.do_not_select_motel_category'));
            return back()->withInput();
        }

        /*Cap nhat gia*/
//        dd($request->selectBoxTypePrice);
        $configPrice = $input['selectBoxTypePrice']['configPrice'];
        $input['config_price_id'] = $configPrice;

        if($request->selectBoxPrice[0]=='1'){
//            dd($request->selectBoxPrice,$request->price);
            $input['min_price'] = $request->price;
            $input['max_price'] = $request->price;
        }

        if($request->image_title==null){
            $input['image_title'] = $motel->image_title;
        }
        else{
            $imageName = time().'.'.transText($request->image_title->getClientOriginalName(),'-');
            $request->image_title->move(public_path('uploads/motels'), $imageName);
            $request->image_title = $imageName;
            $input['image_title'] = '/uploads/motels/'.$imageName;
        }
        /*Cap nhat dia chi*/
        if($request->selectBoxPrice[0]=='1'){
            $input['min_price'] = $request->price;
            $input['max_price'] = $request->price;
        }
        if($request->province_id=='-1'){
            $input['province_id']=null;
        }
        if($request->district_id=='-1'){
            $input['district_id']=null;
        }
        if($request->town_id=='-1'){
            $input['town_id']=null;
        }
        if($request->street_id=='-1'){
            $input['street_id']=null;
        }


        $motel = $this->motelRepository->update($input, $id);

        /*Đồng bộ với thiết bị*/
//        dd($request->fields);
        $device_ids = $request->devices;
        $motel->devices()->sync($device_ids);
        /*Đồng bộ với dịch vụ*/
        $sevice_ids = $request->sevices;
        $motel->sevices()->sync($sevice_ids);

        /*Cac truong cau hinh
            các trường cấu hình trên view nếu để trống sẽ không đẩy lên request
            các trường này khi cập nhật cần để trống trong bd
        */

        /*Lấy các trường của danh mục*/
        $motelCategory = $motel->motelCategory;
        $fieldsOfMotelCategory = $this->configMotelCategoryRepository->findByField('motel_category_id','=',$motelCategory->id,['*'],false);

        $fieldsConfig = $request->fields;
        foreach ($fieldsOfMotelCategory as $fieldOfMotelCategory){
           /* 1.Trường cấu hình của danh mục được request đẩy lên: Lưu lại thông tin update
              2.Trường cấu hình của danh mục không được đẩy lên : Xóa bỏ khỏi db;
           */
            if(isset($fieldsConfig[$fieldOfMotelCategory->field_name])){
                $fieldName = $fieldOfMotelCategory->field_name;               // Ten Truong
                $fieldConfig = $fieldsConfig[$fieldOfMotelCategory->field_name];  // Gia tri request day len
                $valueConfig='';
                if(is_array($fieldConfig)){
                    foreach($fieldConfig as $field){
                        if($valueConfig==''){
                            $valueConfig = $field;
                        }
                        else{
                            $valueConfig .= ':'.$field;
                        }
                    }
                }
                else{
                    $valueConfig = $fieldConfig;
                }
                $config_motel_category = $this->configMotelCategoryRepository->findByField('field_name','=',$fieldName,['*'],false)->first();
                $valueConfigMotel = $this->valueConfigMotelRepository->findWhere([['config_category_id','=',$config_motel_category->id],['motel_id','=',$motel->id]],['*'],false)->first();
                if(!isset($valueConfigMotel)){
                    $valueConfigMotel=new ValueConfigMotel();
                }
                $valueConfigMotel->config_category_id = $config_motel_category->id;
                $valueConfigMotel->value = $valueConfig;
                $valueConfigMotel->motel_id = $motel->id;
                $valueConfigMotel->save();
            }
            else{
                $valueConfigMotel = $this->valueConfigMotelRepository->findWhere([['config_category_id','=',$fieldOfMotelCategory->id],['motel_id','=',$motel->id]],['*'],false)->first();
                if(isset($valueConfigMotel)){
                    $this->valueConfigMotelRepository->delete($valueConfigMotel->id);
                }
            }
        }

//        foreach ($fieldsConfig as $fieldName=>$fieldConfig){    // fieldName: ten truong; $fieldConfig: Value request đẩy lên
//            $valueConfig='';
//            if(is_array($fieldConfig)){
//                foreach($fieldConfig as $field){
//                    if($valueConfig==''){
//                        $valueConfig = $field;
//                    }
//                    else{
//                        $valueConfig .= ':'.$field;
//                    }
//                }
//            }
//            else{
//                $valueConfig = $fieldConfig;
//            }
//            $config_motel_category = $this->configMotelCategoryRepository->findByField('field_name','=',$fieldName,['*'],false)->first();
//            $valueConfigMotel = $this->valueConfigMotelRepository->findWhere([['config_category_id','=',$config_motel_category->id],['motel_id','=',$motel->id]],['*'],false)->first();
//            if(!isset($valueConfigMotel)){
//                $valueConfigMotel=new ValueConfigMotel();
//            }
//            $valueConfigMotel->config_category_id = $config_motel_category->id;
//            $valueConfigMotel->value = $valueConfig;
//            $valueConfigMotel->motel_id = $motel->id;
//            $valueConfigMotel->save();
//
//        }

        Flash::success(__('messages.motel_updated'));
        if($input['save']==='save_edit'){
            return redirect(route('admin.motels.edit', $motel->id));
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.motels.create'));
        }
        else{
            return redirect(route('admin.motels.index'));
        }

    }

    public function hasIn($name, $fieldsConfig){
        foreach ($fieldsConfig as $fieldName=>$value){
            if($fieldName==$name){
                return true;
            }
        }
        return false;
    }

    /**
     * Remove the specified Motel from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    private function destroyValueConfig($motelId){
        $valuesConfigMotelCategory =  $this->valueConfigMotelRepository->findByField('motel_id','=',$motelId,['*'],false);
        foreach ($valuesConfigMotelCategory as $value){
            $this->valueConfigMotelRepository->delete($value->id);
        }
    }

    private function checkMotels($ids){
        foreach ($ids as $id){
            $motel = $this->motelRepository->findWithoutFail($id);
            if (empty($motel)) {
                return false;
            }
        }
        return true;
    }

    /*          Xóa motel
     *      1: Xóa room
     *      2: Xóa thiết bị
     *      3: Xóa dịch vụ
     *      4: Xóa motel đã lưu motel_save (người dùng đã lưu) ??
     *      5: Xóa các giá trị trường cấu hình
     *      6: Xóa motel
     * */
    public function removeRoom(){

    }
    public function removeDevice($idMotel){
        $devivesMotel = $this->deviceMotelRepository->findByField('motel_id','=',$idMotel,['*'],false);
        $ids = [];
        foreach ($devivesMotel as $devive){
            $ids[]=$devive->id;
        }
        $this->deviceMotelRepository->destroy_multiple($ids);
    }
    public function removeSevice($idMotel){
        $sevivesMotel = $this->seviceMotelRepository->findByField('motel_id','=',$idMotel,['*'],false);
        $ids = [];
        foreach ($sevivesMotel as $sevive){
            $ids[]=$sevive->id;
        }
        $this->seviceMotelRepository->destroy_multiple($ids);
    }
    public function removeMotelSaved($idMotel){
        $motelsSave = $this->motelSaveRepository->findByField('motel_id','=',$idMotel,['*'],false);
        $ids = [];
        foreach ($motelsSave as $motelSave){
            $ids[]=$motelSave->id;
        }

        $this->motelSaveRepository->destroy_multiple($ids);
    }
    public function removeValueConfig($idMotel){
        $valuesConfig = $this->valueConfigMotelRepository->findByField('motel_id','=',$idMotel,['*'],false);
        $ids = [];
        foreach ($valuesConfig as $valueConfig){
            $ids[]=$valueConfig->id;
        }

        $this->valueConfigMotelRepository->destroy_multiple($ids);
    }



    public function destroy($id,Request $request)
    {
        if($id=='MULTI'){
            if($request->ids!=null){
                // Neu xuat hien loi khong xoa gi ca. Đưa ra lỗi
                if($this->checkMotels($request->ids)){
                    foreach ($request->ids as $id){
                        $this->removeDevice($id);
                        $this->removeSevice($id);
                        $this->removeMotelSaved($id);
                        $this->removeValueConfig($id);
                    }
                    $this->motelRepository->destroy_multiple($request->ids);
                    Flash::success(__('messages.motel_delete_successfully'));
                }
                else{
                    Flash::error(__('messages.motel_not_found '));
                }
                return redirect(route('admin.motels.index'));
            }
            else{
                Flash::error(__('messages.no_value_select'));
                return redirect(route('admin.motels.index'));
            }
        }
        else{
            $motel = $this->motelRepository->findWithoutFail($id);
            if (empty($motel)) {
                Flash::error(__('messages.motel_not_found'));
                return redirect(route('admin.motels.index'));
            }
            $this->removeDevice($id);
            $this->removeSevice($id);
            $this->removeMotelSaved($id);
            $this->removeValueConfig($id);
            $this->motelRepository->delete($id);


            Flash::success(__('messages.motel_delete_successfully'));

            return redirect(route('admin.motels.index'));
        }
    }
}

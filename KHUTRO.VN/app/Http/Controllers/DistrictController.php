<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDistrictRequest;
use App\Http\Requests\UpdateDistrictRequest;
use App\Repositories\DistrictRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\TownRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DistrictController extends AppBaseController
{
    /** @var  DistrictRepository */
    private $districtRepository;
    private $provinceRepository;
    private $townRepository;

    public function __construct(DistrictRepository $districtRepo, ProvinceRepository $provinceRepo, TownRepository $townRepo)
    {
        $this->districtRepository = $districtRepo;
        $this->provinceRepository = $provinceRepo;
        $this->townRepository = $townRepo;
    }

    /**
     * Display a listing of the District.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $searchCondition = [];
        if(!empty($search)){
            if(!is_null($search['id'])){
                array_push($searchCondition,['id','=', $search['id']]);
            }
            if (!is_null($search['name'])) {
                array_push($searchCondition,['name','LIKE','%'.$search['name'].'%']);
            }
            if (!is_null($search['description'])) {
                array_push($searchCondition,['description','LIKE','%'.$search['description'].'%']);
            }

            $districts = $this->districtRepository->findWhere($searchCondition);
            if (count($districts)<1) {
                Flash::error('Thông tin tìm kiếm chưa được nhập hoặc không đúng, vui lòng kiểm tra lại');
            }
            $districts = $this->districtRepository->findWhere($searchCondition,['*'],true,5);
        }else{
            $districts = $this->districtRepository->paginate(5 );

        }
        return view('backend.districts.index')
            ->with('districts', $districts);
    }

    /**
     * Show the form for creating a new District.
     *
     * @return Response
     */
    public function create()
    {

        $district = null;
        $provinces = $this->provinceRepository->getAllForSelectBox();
        return view('backend.districts.create')->with('provinces',$provinces);
    }

    /**
     * Store a newly created District in storage.
     *
     * @param CreateDistrictRequest $request
     *
     * @return Response
     */
    public function store(CreateDistrictRequest $request)
    {
        $input = $request->all();

        $district = $this->districtRepository->create($input);

        Flash::success('District saved successfully.');

        if($input['save']==='save_edit'){
            return redirect(route('admin.districts.edit', $district->id));
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.districts.create'));
        }
        else{
            return redirect(route('admin.districts.index'));
        }
    }

    /**
     * Display the specified District.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $district = $this->districtRepository->findWithoutFail($id);

        if (empty($district)) {
            Flash::error('District not found');

            return redirect(route('admin.districts.index'));
        }

        return view('backend.districts.show')->with('district', $district);
    }

    /**
     * Show the form for editing the specified District.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $district = $this->districtRepository->findWithoutFail($id);
        $provinces = $this->provinceRepository->getAllForSelectBox(['*'],$id);

        if (empty($district)) {
            Flash::error('District not found');

            return redirect(route('admin.districts.index'));
        }

        return view('backend.districts.edit')->with('district', $district)->with('provinces', $provinces);
    }

    /**
     * Update the specified District in storage.
     *
     * @param  int              $id
     * @param UpdateDistrictRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDistrictRequest $request)
    {
        $input = $request->all();
        $district = $this->districtRepository->update($request->all(), $id);

        if($input['save']==='save_edit'){
            Flash::success('district updated successfully..');
            return redirect(route('admin.districts.edit',$district->id));
        }
        elseif ($input['save']==='save_new'){
            Flash::success('district updated successfully..');
            return redirect(route('admin.districts.create'));
        }
        else{
            Flash::success('district updated successfully.');

            return redirect(route('admin.districts.index'));
        }
    }

    /**
     * Remove the specified District from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id, Request $request)
    {

        if ($id == 'MULTI') {
            if (($request->ids)!=null){
                foreach ($request->ids as $id){
                    $district = $this->districtRepository->findWithoutFail($id);
                    if (empty($district)) {
                        Flash::error('district not found');
                        return redirect(route('admin.districts.index'));
                    }
                    else{
                        $this->districtRepository->destroy_multiple($request ->ids);
                        Flash::success('district deleted successfully.');
                        return redirect(route('admin.districts.index'));
                    }
                }
            }
            else{
                Flash::error(__('messages.district_must_select_a_district_to_delete'));
                return redirect(route('admin.districts.index'));
            }
        }
        else{
            $district = $this->districtRepository->findWithoutFail($id);

            if (empty($district)) {
                Flash::error('district not found');
                return redirect(route('admin.districts.index'));
            }

            $this->districtRepository->delete($id);

            Flash::success('district deleted successfully.');

            return redirect(route('admin.districts.index'));
        }

    }


    public function duplicate($id)
    {
        $district = $this->districtRepository->findWithoutFail($id);

        if (empty($district)) {
            Flash::error('Table not found');

            return redirect(route('admin.districts.index'));
        }
        $type = 'DUPLICATE';
        return view('backend.districts.edit', compact('type'))->with('district', $district);
    }


    public function exportExcel(Request $request)
    {
        $type = $request->type;
        $districts = $this->districtRepository->all();
        $data = $districts->toArray();
        if ($type == 'xls') {
            Excel::create('Filename', function ($excel) use ($data) {

                $excel->sheet('Sheetname', function ($sheet) use ($data) {

                    $sheet->fromArray($data);

                });

            })->export('xls');
        } elseif ($type == 'csv') {
            Excel::create('Filename', function ($excel) use ($data) {

                $excel->sheet('Sheetname', function ($sheet) use ($data) {

                    $sheet->fromArray($data);

                });

            })->export('csv');
        }
    }


    public function common_action(Request $request){
        $submit_type = $request->submit_type;
        $ids = $request->ids;
        if($submit_type == 'DELETE_MULTI'){
            $this->destroy('MULTI', $request);
        }else if ($submit_type == 'ACTIVE_MULTI'){
            if (empty($ids)){
                Flash::warning(__('No value is selected. Check again!'));
            } else {
                foreach ($ids as $id){
                    $district = $this->districtRepository->findWithoutFail($id);
                    $district->active  = 1;
                    $district->save();
                }
                Flash::success('District update active successfully.');
            }

            return redirect(route('admin.districts.index'));
        }else if ($submit_type == 'INACTIVE_MULTI'){
            if (empty($ids)){
                Flash::warning(__('No value is selected. Check again!'));
            } else {
                foreach ($ids as $id){
                    $district = $this->districtRepository->findWithoutFail($id);
                    $district->active  = 0;
                    $district->save();
                }
                Flash::success('District update active successfully.');
            }
        }
        return redirect(route('admin.districts.index'));

    }
}

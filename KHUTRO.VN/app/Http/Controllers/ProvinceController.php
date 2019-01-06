<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProvinceRequest;
use App\Http\Requests\UpdateProvinceRequest;
use App\Repositories\ProvinceRepository;
use App\Repositories\DistrictRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Maatwebsite\Excel\Facades\Excel;

class ProvinceController extends AppBaseController
{
    /** @var  ProvinceRepository */
    private $provinceRepository;
    private $districtRepository;


    public function __construct(ProvinceRepository $provinceRepo, DistrictRepository $districtRepo)
    {
        $this->provinceRepository = $provinceRepo;
        $this->districtRepository = $districtRepo;
    }

    /**
     * Display a listing of the Province.
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

            $provinces = $this->provinceRepository->findWhere($searchCondition);
            if (count($provinces)<1) {
                Flash::error('Thông tin tìm kiếm chưa được nhập hoặc không đúng, vui lòng kiểm tra lại');
            }
            $provinces = $this->provinceRepository->findWhere($searchCondition,['*'],true,5);
        }else{
            $provinces = $this->provinceRepository->paginate(5);

        }
        return view('backend.provinces.index')
            ->with('provinces', $provinces);
    }

    /**
     * Show the form for creating a new Province.
     *
     * @return Response
     */
    public function create()
    {
        $provinces = $this->provinceRepository->all();
        return view('backend.provinces.create', compact($provinces));
    }

    /**
     * Store a newly created Province in storage.
     *
     * @param CreateProvinceRequest $request
     *
     * @return Response
     */
    public function store(CreateProvinceRequest $request)
    {
        $input = $request->all();

        $province = $this->provinceRepository->create($input);

        Flash::success('Province saved successfully.');

        if($input['save']==='save_edit'){
            return redirect(route('admin.provinces.edit', $province->id));
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.provinces.create'));
        }
        else{
            return redirect(route('admin.provinces.index'));
        }
    }

    /**
     * Display the specified Province.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $province = $this->provinceRepository->findWithoutFail($id);

        if (empty($province)) {
            Flash::error('Province not found');

            return redirect(route('admin.provinces.index'));
        }

        return view('backend.provinces.show')->with('province', $province);
    }

    /**
     * Show the form for editing the specified Province.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $province = $this->provinceRepository->findWithoutFail($id);

        if (empty($province)) {
            Flash::error('Province not found');

            return redirect(route('admin.provinces.index'));
        }

        return view('backend.provinces.edit')->with('province', $province);
    }

    /**
     * Update the specified Province in storage.
     *
     * @param  int              $id
     * @param UpdateProvinceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProvinceRequest $request)
    {
        $input = $request->all();
        $province = $this->provinceRepository->update($request->all(), $id);
        if($input['save']==='save_edit'){
            Flash::success('Province updated successfully..');
            return redirect(route('admin.provinces.edit',$province->id));
        }
        elseif ($input['save']==='save_new'){
            Flash::success('Province updated successfully..');
            return redirect(route('admin.provinces.create'));
        }
        else{
            Flash::success('Province updated successfully.');

            return redirect(route('admin.provinces.index'));
        }
    }

    /**
     * Remove the specified Province from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id,Request $request )
    {
        if ($id == 'MULTI') {
            if (($request->ids)!=null){
                foreach ($request->ids as $id){
                    $province = $this->provinceRepository->findWithoutFail($id);
                    if (empty($province)) {
                        Flash::error('Province not found');
                        return redirect(route('admin.provinces.index'));
                    }
                    else{
                        $this->provinceRepository->destroy_multiple($request ->ids);
                        Flash::success('Province deleted successfully.');
                        return redirect(route('admin.provinces.index'));
                    }
                }
            }
            else{
                Flash::error(__('messages.category_doc_must_select_a_category_to_delete'));
                return redirect(route('admin.provinces.index'));
            }
        }
        else{
            $province = $this->provinceRepository->findWithoutFail($id);

            if (empty($province)) {
                Flash::error('Province not found');
                return redirect(route('admin.provinces.index'));
            }

            $this->provinceRepository->delete($id);

            Flash::success('Province deleted successfully.');

            return redirect(route('admin.provinces.index'));
        }
    }


    public function duplicate($id)
    {
        $province = $this->provinceRepository->findWithoutFail($id);

        if (empty($province)) {
            Flash::error('Table not found');

            return redirect(route('admin.provinces.index'));
        }
        $type = 'DUPLICATE';
        return view('backend.provinces.edit', compact('type'))->with('province', $province);
    }


    public function exportExcel(Request $request)
    {
        $type = $request->type;
        $provinces = $this->provinceRepository->all();
        $data = $provinces->toArray();
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
                    $province = $this->provinceRepository->findWithoutFail($id);
                    $province->active  = 1;
                    $province->save();
                }
                Flash::success('Province update active successfully.');
            }

            return redirect(route('admin.provinces.index'));
        }else if ($submit_type == 'INACTIVE_MULTI'){
            if (empty($ids)){
                Flash::warning(__('No value is selected. Check again!'));
            } else {
                foreach ($ids as $id){
                    $province = $this->provinceRepository->findWithoutFail($id);
                    $province->active  = 0;
                    $province->save();
                }
                Flash::success('Province update active successfully.');
            }
        }
        return redirect(route('admin.provinces.index'));

    }
}





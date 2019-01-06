<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTownRequest;
use App\Http\Requests\UpdateTownRequest;
use App\Repositories\TownRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\StreetRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TownController extends AppBaseController
{
    /** @var  TownRepository */
    private $townRepository;
    private $districtRepository;
    private $streetRepository;

    public function __construct(TownRepository $townRepo, StreetRepository $streetRepo, DistrictRepository $districtRepo)
    {
        $this->townRepository = $townRepo;
        $this->districtRepository = $districtRepo;
        $this->streetRepository = $streetRepo;
    }

    /**
     * Display a listing of the Town.
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

            $towns = $this->townRepository->findWhere($searchCondition);
            if (count($towns)<1) {
                Flash::error('Thông tin tìm kiếm chưa được nhập hoặc không đúng, vui lòng kiểm tra lại');
            }
            $towns = $this->townRepository->findWhere($searchCondition,['*'],true,5);
        }else{
            $towns = $this->townRepository->paginate(5);

        }
        return view('backend.towns.index')
            ->with('towns', $towns);
    }

    /**
     * Show the form for creating a new Town.
     *
     * @return Response
     */
    public function create()
    {
        $town = null;
        $districts = $this->districtRepository->getAllForSelectBox();
        return view('backend.towns.create')->with('districts',$districts);
    }


    /**
     * Store a newly created Town in storage.
     *
     * @param CreateTownRequest $request
     *
     * @return Response
     */
    public function store(CreateTownRequest $request)
    {

        $input = $request->all();
        $town = $this->townRepository->create($input);

        Flash::success('Town saved successfully.');

        if($input['save']==='save_edit'){
            return redirect(route('admin.towns.edit', $town->id));
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.towns.create'));
        }
        else{
            return redirect(route('admin.towns.index'));
        }
    }

    /**
     * Display the specified Town.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $town = $this->townRepository->findWithoutFail($id);

        if (empty($town)) {
            Flash::error('Town not found');

            return redirect(route('admin.towns.index'));
        }

        return view('backend.towns.show')->with('town', $town);
    }

    /**
     * Show the form for editing the specified Town.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $town = $this->townRepository->findWithoutFail($id);
        $districts = $this->districtRepository->getAllForSelectBox(['*'],$id);

        if (empty($town)) {
            Flash::error('Town not found');

            return redirect(route('admin.towns.index'));
        }

        return view('backend.towns.edit')->with('town', $town)->with('districts', $districts);
    }

    /**
     * Update the specified Town in storage.
     *
     * @param  int              $id
     * @param UpdateTownRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTownRequest $request)
    {
        $input = $request->all();
        $town = $this->townRepository->update($request->all(), $id);

        if($input['save']==='save_edit'){
            Flash::success('town updated successfully..');
            return redirect(route('admin.towns.edit',$town->id));
        }
        elseif ($input['save']==='save_new'){
            Flash::success('town updated successfully..');
            return redirect(route('admin.towns.create'));
        }
        else{
            Flash::success('town updated successfully.');

            return redirect(route('admin.towns.index'));
        }
    }

    /**
     * Remove the specified Town from storage.
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
                    $town = $this->townRepository->findWithoutFail($id);
                    if (empty($town)) {
                        Flash::error('district not found');
                        return redirect(route('admin.towns.index'));
                    }
                    else{
                        $this->townRepository->destroy_multiple($request ->ids);
                        Flash::success('district deleted successfully.');
                        return redirect(route('admin.towns.index'));
                    }
                }
            }
            else{
                Flash::error(__('messages.district_must_select_a_district_to_delete'));
                return redirect(route('admin.towns.index'));
            }
        }
        else{
            $town = $this->townRepository->findWithoutFail($id);

            if (empty($town)) {
                Flash::error('town not found');
                return redirect(route('admin.towns.index'));
            }

            $this->townRepository->delete($id);

            Flash::success('town deleted successfully.');

            return redirect(route('admin.towns.index'));
        }
    }


    public function duplicate($id)
    {
        $town = $this->townRepository->findWithoutFail($id);

        if (empty($district)) {
            Flash::error('Table not found');

            return redirect(route('admin.towns.index'));
        }
        $type = 'DUPLICATE';
        return view('backend.towns.edit', compact('type'))->with('town', $town);
    }


    public function exportExcel(Request $request)
    {
        $type = $request->type;
        $towns = $this->townRepository->all();
        $data = $towns->toArray();
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
                    $town = $this->townRepository->findWithoutFail($id);
                    $town->active  = 1;
                    $town->save();
                }
                Flash::success('Town update active successfully.');
            }

            return redirect(route('admin.towns.index'));
        }else if ($submit_type == 'INACTIVE_MULTI'){
            if (empty($ids)){
                Flash::warning(__('No value is selected. Check again!'));
            } else {
                foreach ($ids as $id){
                    $town = $this->townRepository->findWithoutFail($id);
                    $town->active  = 0;
                    $town->save();
                }
                Flash::success('Town update active successfully.');
            }
        }
        return redirect(route('admin.towns.index'));

    }
}

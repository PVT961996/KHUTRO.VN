<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStreetRequest;
use App\Http\Requests\UpdateStreetRequest;
use App\Repositories\StreetRepository;
use App\Repositories\TownRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class StreetController extends AppBaseController
{
    /** @var  StreetRepository */
    private $streetRepository;
    private $townRepository;

    public function __construct(StreetRepository $streetRepo, TownRepository $townRepo)
    {
        $this->streetRepository = $streetRepo;
        $this->townRepository = $townRepo;
    }

    /**
     * Display a listing of the Street.
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

            $streets = $this->streetRepository->findWhere($searchCondition);
            if (count($streets)<1) {
                Flash::error('Thông tin tìm kiếm chưa được nhập hoặc không đúng, vui lòng kiểm tra lại');
            }
            $streets = $this->streetRepository->findWhere($searchCondition,['*'],true,5);
        }else{
            $streets = $this->streetRepository->paginate(5);

        }
        return view('backend.streets.index')
            ->with('streets', $streets);
    }

    /**
     * Show the form for creating a new Street.
     *
     * @return Response
     */
    public function create()
    {
        $street = null;
        $towns = $this->townRepository->getAllForSelectBox();
        return view('backend.streets.create')->with('towns',$towns);
    }

    /**
     * Store a newly created Street in storage.
     *
     * @param CreateStreetRequest $request
     *
     * @return Response
     */
    public function store(CreateStreetRequest $request)
    {

        $input = $request->all();
        $street = $this->streetRepository->create($input);

        Flash::success('Street saved successfully.');

        if($input['save']==='save_edit'){
            return redirect(route('admin.streets.edit', $street->id));
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.streets.create'));
        }
        else{
            return redirect(route('admin.streets.index'));
        }
    }

    /**
     * Display the specified Street.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $street = $this->streetRepository->findWithoutFail($id);

        if (empty($street)) {
            Flash::error('Street not found');

            return redirect(route('admin.streets.index'));
        }

        return view('backend.streets.show')->with('street', $street);
    }

    /**
     * Show the form for editing the specified Street.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $street = $this->streetRepository->findWithoutFail($id);
        $towns = $this->townRepository->getAllForSelectBox(['*'],$id);

        if (empty($street)) {
            Flash::error('Street not found');

            return redirect(route('admin.streets.index'));
        }

        return view('backend.streets.edit')->with('street', $street)->with('towns', $towns);
    }

    /**
     * Update the specified Street in storage.
     *
     * @param  int              $id
     * @param UpdateStreetRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStreetRequest $request)
    {
        $input = $request->all();
        $street = $this->streetRepository->update($request->all(), $id);

        if($input['save']==='save_edit'){
            Flash::success('street updated successfully..');
            return redirect(route('admin.streets.edit',$street->id));
        }
        elseif ($input['save']==='save_new'){
            Flash::success('street updated successfully..');
            return redirect(route('admin.streets.create'));
        }
        else{
            Flash::success('street updated successfully.');

            return redirect(route('admin.streets.index'));
        }
    }

    /**
     * Remove the specified Street from storage.
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
                    $street = $this->streetRepository->findWithoutFail($id);
                    if (empty($street)) {
                        Flash::error('district not found');
                        return redirect(route('admin.streets.index'));
                    }
                    else{
                        $this->streetRepository->destroy_multiple($request ->ids);
                        Flash::success('district deleted successfully.');
                        return redirect(route('admin.streets.index'));
                    }
                }
            }
            else{
                Flash::error(__('messages.district_must_select_a_district_to_delete'));
                return redirect(route('admin.streets.index'));
            }
        }
        else{
            $street = $this->streetRepository->findWithoutFail($id);

            if (empty($street)) {
                Flash::error('street not found');
                return redirect(route('admin.streets.index'));
            }

            $this->streetRepository->delete($id);

            Flash::success('street deleted successfully.');

            return redirect(route('admin.streets.index'));
        }
    }


    public function duplicate($id)
    {
        $street = $this->streetRepository->findWithoutFail($id);

        if (empty($district)) {
            Flash::error('Table not found');

            return redirect(route('admin.streets.index'));
        }
        $type = 'DUPLICATE';
        return view('backend.streets.edit', compact('type'))->with('street', $street);
    }


    public function exportExcel(Request $request)
    {
        $type = $request->type;
        $streets = $this->streetRepository->all();
        $data = $streets->toArray();
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
                    $street = $this->streetRepository->findWithoutFail($id);
                    $street->active  = 1;
                    $street->save();
                }
                Flash::success('Street update active successfully.');
            }

            return redirect(route('admin.streets.index'));
        }else if ($submit_type == 'INACTIVE_MULTI'){
            if (empty($ids)){
                Flash::warning(__('No value is selected. Check again!'));
            } else {
                foreach ($ids as $id){
                    $street = $this->streetRepository->findWithoutFail($id);
                    $street->active  = 0;
                    $street->save();
                }
                Flash::success('Street update active successfully.');
            }
        }
        return redirect(route('admin.streets.index'));

    }
}

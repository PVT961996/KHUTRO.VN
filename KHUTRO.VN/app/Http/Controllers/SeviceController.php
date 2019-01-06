<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSeviceRequest;
use App\Http\Requests\UpdateSeviceRequest;
use App\Repositories\MotelRepository;
use App\Repositories\SeviceMotelRepository;
use App\Repositories\SeviceRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SeviceController extends AppBaseController
{
    /** @var  SeviceRepository */
    private $seviceRepository;
    private $motelRepository;
    private $seviceMotelRepository;
    public function __construct(SeviceRepository $seviceRepo, MotelRepository $moteRepo,SeviceMotelRepository $seviceMotelRepo)
    {
        $this->seviceRepository = $seviceRepo;
        $this->motelRepository = $moteRepo;
        $this->seviceMotelRepository = $seviceMotelRepo;
    }

    /**
     * Display a listing of the Sevice.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search=$request->search;
        if(!empty($search)){
            $sevices=$this->seviceRepository->findByField('name','LIKE','%'.$search['name'].'%',['*'],true,10);
        }
        else{
            $sevices = $this->seviceRepository->paginate(10);
        }

        return view('backend.sevices.index')
            ->with('sevices', $sevices);
    }

    /**
     * Show the form for creating a new Sevice.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.sevices.create');
    }

    /**
     * Store a newly created Sevice in storage.
     *
     * @param CreateSeviceRequest $request
     *
     * @return Response
     */
    public function store(CreateSeviceRequest $request)
    {
        $input = $request->all();
        if (!empty($input['image'])) {
            $imageName = time().'.'.transText($request->image->getClientOriginalName(),'-');
            $request->image->move(public_path('uploads/sevices'), $imageName);
            $request->image = $imageName;
            $input['image'] = '/uploads/sevices/'.$imageName;
        }

        $sevice = $this->seviceRepository->create($input);

        Flash::success(__('messages.sevice_add_successfully'));
        if($input['save']==='save_edit'){
            return redirect(route('admin.sevices.edit', $sevice->id));
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.sevices.create'));
        }
        else{
            return redirect(route('admin.sevices.index'));
        }
    }

    /**
     * Display the specified Sevice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sevice = $this->seviceRepository->findWithoutFail($id);

        if (empty($sevice)) {
            Flash::error(__('messages.sevice_not_found'));

            return redirect(route('admin.sevices.index'));
        }

        return view('backend.sevices.show')->with('sevice', $sevice);
    }

    /**
     * Show the form for editing the specified Sevice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sevice = $this->seviceRepository->findWithoutFail($id);

        if (empty($sevice)) {
            Flash::error(__('messages.sevice_not_found '));

            return redirect(route('admin.sevices.index'));
        }

        return view('backend.sevices.edit')->with('sevice', $sevice);
    }

    /**
     * Update the specified Sevice in storage.
     *
     * @param  int              $id
     * @param UpdateSeviceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSeviceRequest $request)
    {
        $sevice = $this->seviceRepository->findWithoutFail($id);
        if (empty($sevice)) {
            Flash::error(__('messages.sevice_not_found '));

            return redirect(route('admin.sevices.index'));
        }
        $input = $request->all();
        if (!empty($input['image'])) {
            $imageName = time().'.'.transText($request->image->getClientOriginalName(),'-');
            $request->image->move(public_path('uploads/sevices'), $imageName);
            $request->image = $imageName;
            $input['image'] = '/uploads/sevices/'.$imageName;
        }

        $sevice = $this->seviceRepository->update($input, $id);

        Flash::success(__('messages.sevice_updated'));

        return redirect(route('admin.sevices.index'));
    }

    /**
     * Remove the specified Sevice from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    private function checkSevices($ids){
        foreach ($ids as $id){
            $sevice = $this->seviceRepository->findWithoutFail($id);
            if (empty($sevice)) {
                return false;
            }
        }
        return true;
    }

    public function destroy($id,Request $request)
    {
        if($id=='MULTI'){
            if($request->ids!=null){
                // Neu xuat hien loi khong xoa gi ca. Đưa ra lỗi
                if($this->checkSevices($request->ids)){
                    $this->seviceRepository->destroy_multiple($request->ids);
                    Flash::success(__('messages.sevice_deleted'));
                }
                else{
                    Flash::error(__('messages.sevice_not_found '));
                }
                return redirect(route('admin.sevices.index'));
            }
            else{
                Flash::error(__('messages.no_value_select'));
                return redirect(route('admin.sevices.index'));
            }
        }
        else{
            $sevice = $this->seviceRepository->findWithoutFail($id);
            if (empty($sevice)) {
                Flash::error(__('messages.no_value_select'));

                return redirect(route('admin.sevices.index'));
            }
            $this->seviceRepository->delete($id);
            Flash::success(__('messages.sevice_deleted'));
            return redirect(route('admin.sevices.index'));
        }

    }

    public function duplicate($id){
        $sevice = $this->seviceRepository->findWithoutFail($id);
        if (empty($sevice)) {
            Flash::error(__('messages.sevice_not_found '));
            return redirect(route('admin.sevices.index'));
        }
        $type = 'DUPLICATE';
        return view('backend.sevices.edit', compact('type'))->with('sevice', $sevice);
    }

    public function exportToFile(Request $request){
        return;
    }
}

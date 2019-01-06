<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDeviceRequest;
use App\Http\Requests\UpdateDeviceRequest;
use App\Repositories\DeviceMotelRepository;
use App\Repositories\DeviceRepository;
use Illuminate\Http\Request;
use Flash;
use Response;

class DeviceController extends AppBaseController
{
    private $deviceRepository;
    private $deviceMotelRepository;

    public function __construct(DeviceRepository $deviceRepo,DeviceMotelRepository $deviceMotelRepo)
    {
        $this->deviceRepository = $deviceRepo;
        $this->deviceMotelRepository = $deviceMotelRepo;

    }

    /**
     * Display a listing of the Device.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search=$request->search;
        if(!empty($search)){
            $devices=$this->deviceRepository->findByField('name','LIKE','%'.$search['name'].'%',['*'],true,10);
        }
        else{
            $devices = $this->deviceRepository->paginate(10);
        }

        return view('backend.devices.index')
            ->with('devices', $devices);
    }

    /**
     * Show the form for creating a new Device.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.devices.create');
    }

    /**
     * Store a newly created Device in storage.
     *
     * @param CreateDeviceRequest $request
     *
     * @return Response
     */
    public function store(CreateDeviceRequest $request)
    {
        $input = $request->all();
        if (!empty($input['image'])) {
            $imageName = time().'.'.transText($request->image->getClientOriginalName(),'-');
            $request->image->move(public_path('uploads/devices'), $imageName);
            $request->image = $imageName;
            $input['image'] = '/uploads/devices/'.$imageName;
        }
        $device = $this->deviceRepository->create($input);

        Flash::success(__('messages.device_add_successfully'));
        if($input['save']==='save_edit'){
            return redirect(route('admin.devices.edit', $device->id));
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.devices.create'));
        }
        else{
            return redirect(route('admin.devices.index'));
        }
    }

    /**
     * Display the specified Device.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $device = $this->deviceRepository->findWithoutFail($id);

        if (empty($device)) {
            Flash::error(__('messages.device_not_found '));

            return redirect(route('admin.devices.index'));
        }

        return view('backend.devices.show')->with('device', $device);
    }

    /**
     * Show the form for editing the specified Device.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $device = $this->deviceRepository->findWithoutFail($id);

        if (empty($device)) {
            Flash::error(__('messages.device_not_found '));

            return redirect(route('admin.devices.index'));
        }

        return view('backend.devices.edit')->with('device', $device);
    }

    /**
     * Update the specified Device in storage.
     *
     * @param  int              $id
     * @param UpdateDeviceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeviceRequest $request)
    {
        $device = $this->deviceRepository->findWithoutFail($id);

        if (empty($device)) {
            Flash::error(__('messages.device_not_found '));

            return redirect(route('admin.devices.index'));
        }
        $input = $request->all();
        if (!empty($input['image'])) {
            $imageName = time().'.'.transText($request->image->getClientOriginalName(),'-');
            $request->image->move(public_path('uploads/devices'), $imageName);
            $request->image = $imageName;
            $input['image'] = '/uploads/devices/'.$imageName;
        }

        $device = $this->deviceRepository->update($input, $id);

        Flash::success(__('messages.device_updated'));
        if($input['save']==='save_edit'){
            return back()->withInput();
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.devices.create'));
        }
        else{
            return redirect(route('admin.devices.index'));
        }
    }

    /**
     * Remove the specified Device from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    private function checkDevices($ids){
        foreach ($ids as $id){
            $device = $this->deviceRepository->findWithoutFail($id);
            if (empty($device)) {
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
                if($this->checkDevices($request->ids)){
                    $this->deviceRepository->destroy_multiple($request->ids);
                    Flash::success(__('messages.device_deleted'));
                }
                else{
                    Flash::error(__('messages.device_not_found '));
                }
                return redirect(route('admin.devices.index'));
            }
            else{
                Flash::error(__('messages.no_value_select'));
                return redirect(route('admin.devices.index'));
            }
        }
        else{
            $device = $this->deviceRepository->findWithoutFail($id);
            if (empty($device)) {
                Flash::error(__('messages.device_not_found'));

                return redirect(route('admin.devices.index'));
            }
            $this->deviceRepository->delete($id);
            Flash::success(__('messages.device_deleted'));
            return redirect(route('admin.devices.index'));
        }

    }

    public function duplicate($id){
        $device = $this->deviceRepository->findWithoutFail($id);
        if (empty($device)) {
            Flash::error(__('messages.no_value_select'));
            return redirect(route('admin.devices.index'));
        }
        $type = 'DUPLICATE';
        return view('backend.devices.edit', compact('type'))->with('device', $device);
    }

    public function exportToFile(Request $request){
        return;
    }

}

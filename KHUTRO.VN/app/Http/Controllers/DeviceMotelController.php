<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDeviceMotelRequest;
use App\Http\Requests\UpdateDeviceMotelRequest;
use App\Repositories\DeviceMotelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DeviceMotelController extends AppBaseController
{
    /** @var  DeviceMotelRepository */
    private $deviceMotelRepository;

    public function __construct(DeviceMotelRepository $deviceMotelRepo)
    {
        $this->deviceMotelRepository = $deviceMotelRepo;
    }

    /**
     * Display a listing of the DeviceMotel.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->deviceMotelRepository->pushCriteria(new RequestCriteria($request));
        $deviceMotels = $this->deviceMotelRepository->all();

        return view('backend.device_motels.index')
            ->with('deviceMotels', $deviceMotels);
    }

    /**
     * Show the form for creating a new DeviceMotel.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.device_motels.create');
    }

    /**
     * Store a newly created DeviceMotel in storage.
     *
     * @param CreateDeviceMotelRequest $request
     *
     * @return Response
     */
    public function store(CreateDeviceMotelRequest $request)
    {
        $input = $request->all();

        $deviceMotel = $this->deviceMotelRepository->create($input);

        Flash::success('Device Motel saved successfully.');

        return redirect(route('admin.deviceMotels.index'));
    }

    /**
     * Display the specified DeviceMotel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $deviceMotel = $this->deviceMotelRepository->findWithoutFail($id);

        if (empty($deviceMotel)) {
            Flash::error('Device Motel not found');

            return redirect(route('admin.deviceMotels.index'));
        }

        return view('backend.device_motels.show')->with('deviceMotel', $deviceMotel);
    }

    /**
     * Show the form for editing the specified DeviceMotel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $deviceMotel = $this->deviceMotelRepository->findWithoutFail($id);

        if (empty($deviceMotel)) {
            Flash::error('Device Motel not found');

            return redirect(route('admin.deviceMotels.index'));
        }

        return view('backend.device_motels.edit')->with('deviceMotel', $deviceMotel);
    }

    /**
     * Update the specified DeviceMotel in storage.
     *
     * @param  int              $id
     * @param UpdateDeviceMotelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeviceMotelRequest $request)
    {
        $deviceMotel = $this->deviceMotelRepository->findWithoutFail($id);

        if (empty($deviceMotel)) {
            Flash::error('Device Motel not found');

            return redirect(route('admin.deviceMotels.index'));
        }

        $deviceMotel = $this->deviceMotelRepository->update($request->all(), $id);

        Flash::success('Device Motel updated successfully.');

        return redirect(route('admin.deviceMotels.index'));
    }

    /**
     * Remove the specified DeviceMotel from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deviceMotel = $this->deviceMotelRepository->findWithoutFail($id);

        if (empty($deviceMotel)) {
            Flash::error('Device Motel not found');

            return redirect(route('admin.deviceMotels.index'));
        }

        $this->deviceMotelRepository->delete($id);

        Flash::success('Device Motel deleted successfully.');

        return redirect(route('admin.deviceMotels.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSeviceMotelRequest;
use App\Http\Requests\UpdateSeviceMotelRequest;
use App\Repositories\SeviceMotelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SeviceMotelController extends AppBaseController
{
    /** @var  SeviceMotelRepository */
    private $seviceMotelRepository;

    public function __construct(SeviceMotelRepository $seviceMotelRepo)
    {
        $this->seviceMotelRepository = $seviceMotelRepo;
    }

    /**
     * Display a listing of the SeviceMotel.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->seviceMotelRepository->pushCriteria(new RequestCriteria($request));
        $seviceMotels = $this->seviceMotelRepository->all();

        return view('backend.sevice_motels.index')
            ->with('seviceMotels', $seviceMotels);
    }

    /**
     * Show the form for creating a new SeviceMotel.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.sevice_motels.create');
    }

    /**
     * Store a newly created SeviceMotel in storage.
     *
     * @param CreateSeviceMotelRequest $request
     *
     * @return Response
     */
    public function store(CreateSeviceMotelRequest $request)
    {
        $input = $request->all();

        $seviceMotel = $this->seviceMotelRepository->create($input);

        Flash::success('Sevice Motel saved successfully.');

        return redirect(route('admin.seviceMotels.index'));
    }

    /**
     * Display the specified SeviceMotel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $seviceMotel = $this->seviceMotelRepository->findWithoutFail($id);

        if (empty($seviceMotel)) {
            Flash::error('Sevice Motel not found');

            return redirect(route('admin.seviceMotels.index'));
        }

        return view('backend.sevice_motels.show')->with('seviceMotel', $seviceMotel);
    }

    /**
     * Show the form for editing the specified SeviceMotel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $seviceMotel = $this->seviceMotelRepository->findWithoutFail($id);

        if (empty($seviceMotel)) {
            Flash::error('Sevice Motel not found');

            return redirect(route('admin.seviceMotels.index'));
        }

        return view('backend.sevice_motels.edit')->with('seviceMotel', $seviceMotel);
    }

    /**
     * Update the specified SeviceMotel in storage.
     *
     * @param  int              $id
     * @param UpdateSeviceMotelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSeviceMotelRequest $request)
    {
        $seviceMotel = $this->seviceMotelRepository->findWithoutFail($id);

        if (empty($seviceMotel)) {
            Flash::error('Sevice Motel not found');

            return redirect(route('admin.seviceMotels.index'));
        }

        $seviceMotel = $this->seviceMotelRepository->update($request->all(), $id);

        Flash::success('Sevice Motel updated successfully.');

        return redirect(route('admin.seviceMotels.index'));
    }

    /**
     * Remove the specified SeviceMotel from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $seviceMotel = $this->seviceMotelRepository->findWithoutFail($id);

        if (empty($seviceMotel)) {
            Flash::error('Sevice Motel not found');

            return redirect(route('admin.seviceMotels.index'));
        }

        $this->seviceMotelRepository->delete($id);

        Flash::success('Sevice Motel deleted successfully.');

        return redirect(route('admin.seviceMotels.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateValueConfigMotelRequest;
use App\Http\Requests\UpdateValueConfigMotelRequest;
use App\Repositories\ValueConfigMotelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ValueConfigMotelController extends AppBaseController
{
    /** @var  ValueConfigMotelRepository */
    private $valueConfigMotelRepository;

    public function __construct(ValueConfigMotelRepository $valueConfigMotelRepo)
    {
        $this->valueConfigMotelRepository = $valueConfigMotelRepo;
    }

    /**
     * Display a listing of the ValueConfigMotel.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->valueConfigMotelRepository->pushCriteria(new RequestCriteria($request));
        $valueConfigMotels = $this->valueConfigMotelRepository->all();

        return view('backend.value_config_motels.index')
            ->with('valueConfigMotels', $valueConfigMotels);
    }

    /**
     * Show the form for creating a new ValueConfigMotel.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.value_config_motels.create');
    }

    /**
     * Store a newly created ValueConfigMotel in storage.
     *
     * @param CreateValueConfigMotelRequest $request
     *
     * @return Response
     */
    public function store(CreateValueConfigMotelRequest $request)
    {
        $input = $request->all();

        $valueConfigMotel = $this->valueConfigMotelRepository->create($input);

        Flash::success('Value Config Motel saved successfully.');

        return redirect(route('admin.valueConfigMotels.index'));
    }

    /**
     * Display the specified ValueConfigMotel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $valueConfigMotel = $this->valueConfigMotelRepository->findWithoutFail($id);

        if (empty($valueConfigMotel)) {
            Flash::error('Value Config Motel not found');

            return redirect(route('admin.valueConfigMotels.index'));
        }

        return view('backend.value_config_motels.show')->with('valueConfigMotel', $valueConfigMotel);
    }

    /**
     * Show the form for editing the specified ValueConfigMotel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $valueConfigMotel = $this->valueConfigMotelRepository->findWithoutFail($id);

        if (empty($valueConfigMotel)) {
            Flash::error('Value Config Motel not found');

            return redirect(route('admin.valueConfigMotels.index'));
        }

        return view('backend.value_config_motels.edit')->with('valueConfigMotel', $valueConfigMotel);
    }

    /**
     * Update the specified ValueConfigMotel in storage.
     *
     * @param  int              $id
     * @param UpdateValueConfigMotelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateValueConfigMotelRequest $request)
    {
        $valueConfigMotel = $this->valueConfigMotelRepository->findWithoutFail($id);

        if (empty($valueConfigMotel)) {
            Flash::error('Value Config Motel not found');

            return redirect(route('admin.valueConfigMotels.index'));
        }

        $valueConfigMotel = $this->valueConfigMotelRepository->update($request->all(), $id);

        Flash::success('Value Config Motel updated successfully.');

        return redirect(route('admin.valueConfigMotels.index'));
    }

    /**
     * Remove the specified ValueConfigMotel from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $valueConfigMotel = $this->valueConfigMotelRepository->findWithoutFail($id);

        if (empty($valueConfigMotel)) {
            Flash::error('Value Config Motel not found');

            return redirect(route('admin.valueConfigMotels.index'));
        }

        $this->valueConfigMotelRepository->delete($id);

        Flash::success('Value Config Motel deleted successfully.');

        return redirect(route('admin.valueConfigMotels.index'));
    }
}

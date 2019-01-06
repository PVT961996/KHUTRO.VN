<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMotelSaveRequest;
use App\Http\Requests\UpdateMotelSaveRequest;
use App\Repositories\MotelSaveRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MotelSaveController extends AppBaseController
{
    /** @var  MotelSaveRepository */
    private $motelSaveRepository;

    public function __construct(MotelSaveRepository $motelSaveRepo)
    {
        $this->motelSaveRepository = $motelSaveRepo;
    }

    /**
     * Display a listing of the MotelSave.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->motelSaveRepository->pushCriteria(new RequestCriteria($request));
        $motelSaves = $this->motelSaveRepository->all();

        return view('backend.motel_saves.index')
            ->with('motelSaves', $motelSaves);
    }

    /**
     * Show the form for creating a new MotelSave.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.motel_saves.create');
    }

    /**
     * Store a newly created MotelSave in storage.
     *
     * @param CreateMotelSaveRequest $request
     *
     * @return Response
     */
    public function store(CreateMotelSaveRequest $request)
    {
        $input = $request->all();

        $motelSave = $this->motelSaveRepository->create($input);

        Flash::success('Motel Save saved successfully.');

        return redirect(route('admin.motelSaves.index'));
    }

    /**
     * Display the specified MotelSave.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $motelSave = $this->motelSaveRepository->findWithoutFail($id);

        if (empty($motelSave)) {
            Flash::error('Motel Save not found');

            return redirect(route('admin.motelSaves.index'));
        }

        return view('backend.motel_saves.show')->with('motelSave', $motelSave);
    }

    /**
     * Show the form for editing the specified MotelSave.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $motelSave = $this->motelSaveRepository->findWithoutFail($id);

        if (empty($motelSave)) {
            Flash::error('Motel Save not found');

            return redirect(route('admin.motelSaves.index'));
        }

        return view('backend.motel_saves.edit')->with('motelSave', $motelSave);
    }

    /**
     * Update the specified MotelSave in storage.
     *
     * @param  int              $id
     * @param UpdateMotelSaveRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMotelSaveRequest $request)
    {
        $motelSave = $this->motelSaveRepository->findWithoutFail($id);

        if (empty($motelSave)) {
            Flash::error('Motel Save not found');

            return redirect(route('admin.motelSaves.index'));
        }

        $motelSave = $this->motelSaveRepository->update($request->all(), $id);

        Flash::success('Motel Save updated successfully.');

        return redirect(route('admin.motelSaves.index'));
    }

    /**
     * Remove the specified MotelSave from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $motelSave = $this->motelSaveRepository->findWithoutFail($id);

        if (empty($motelSave)) {
            Flash::error('Motel Save not found');

            return redirect(route('admin.motelSaves.index'));
        }

        $this->motelSaveRepository->delete($id);

        Flash::success('Motel Save deleted successfully.');

        return redirect(route('admin.motelSaves.index'));
    }
}

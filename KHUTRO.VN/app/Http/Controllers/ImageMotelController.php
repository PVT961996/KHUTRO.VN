<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateImageMotelRequest;
use App\Http\Requests\UpdateImageMotelRequest;
use App\Repositories\ImageMotelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ImageMotelController extends AppBaseController
{
    /** @var  ImageMotelRepository */
    private $imageMotelRepository;

    public function __construct(ImageMotelRepository $imageMotelRepo)
    {
        $this->imageMotelRepository = $imageMotelRepo;
    }

    /**
     * Display a listing of the ImageMotel.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->imageMotelRepository->pushCriteria(new RequestCriteria($request));
        $imageMotels = $this->imageMotelRepository->all();

        return view('backend.image_motels.index')
            ->with('imageMotels', $imageMotels);
    }

    /**
     * Show the form for creating a new ImageMotel.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.image_motels.create');
    }

    /**
     * Store a newly created ImageMotel in storage.
     *
     * @param CreateImageMotelRequest $request
     *
     * @return Response
     */
    public function store(CreateImageMotelRequest $request)
    {
        $input = $request->all();

        $imageMotel = $this->imageMotelRepository->create($input);

        Flash::success('Image Motel saved successfully.');

        return redirect(route('admin.imageMotels.index'));
    }

    /**
     * Display the specified ImageMotel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $imageMotel = $this->imageMotelRepository->findWithoutFail($id);

        if (empty($imageMotel)) {
            Flash::error('Image Motel not found');

            return redirect(route('admin.imageMotels.index'));
        }

        return view('backend.image_motels.show')->with('imageMotel', $imageMotel);
    }

    /**
     * Show the form for editing the specified ImageMotel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $imageMotel = $this->imageMotelRepository->findWithoutFail($id);

        if (empty($imageMotel)) {
            Flash::error('Image Motel not found');

            return redirect(route('admin.imageMotels.index'));
        }

        return view('backend.image_motels.edit')->with('imageMotel', $imageMotel);
    }

    /**
     * Update the specified ImageMotel in storage.
     *
     * @param  int              $id
     * @param UpdateImageMotelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateImageMotelRequest $request)
    {
        $imageMotel = $this->imageMotelRepository->findWithoutFail($id);

        if (empty($imageMotel)) {
            Flash::error('Image Motel not found');

            return redirect(route('admin.imageMotels.index'));
        }

        $imageMotel = $this->imageMotelRepository->update($request->all(), $id);

        Flash::success('Image Motel updated successfully.');

        return redirect(route('admin.imageMotels.index'));
    }

    /**
     * Remove the specified ImageMotel from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $imageMotel = $this->imageMotelRepository->findWithoutFail($id);

        if (empty($imageMotel)) {
            Flash::error('Image Motel not found');

            return redirect(route('admin.imageMotels.index'));
        }

        $this->imageMotelRepository->delete($id);

        Flash::success('Image Motel deleted successfully.');

        return redirect(route('admin.imageMotels.index'));
    }
}

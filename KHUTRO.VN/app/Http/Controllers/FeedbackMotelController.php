<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFeedbackMotelRequest;
use App\Http\Requests\UpdateFeedbackMotelRequest;
use App\Repositories\FeedbackMotelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class FeedbackMotelController extends AppBaseController
{
    /** @var  FeedbackMotelRepository */
    private $feedbackMotelRepository;

    public function __construct(FeedbackMotelRepository $feedbackMotelRepo)
    {
        $this->feedbackMotelRepository = $feedbackMotelRepo;
    }

    /**
     * Display a listing of the FeedbackMotel.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->feedbackMotelRepository->pushCriteria(new RequestCriteria($request));
        $feedbackMotels = $this->feedbackMotelRepository->all();

        return view('backend.feedback_motels.index')
            ->with('feedbackMotels', $feedbackMotels);
    }

    /**
     * Show the form for creating a new FeedbackMotel.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.feedback_motels.create');
    }

    /**
     * Store a newly created FeedbackMotel in storage.
     *
     * @param CreateFeedbackMotelRequest $request
     *
     * @return Response
     */
    public function store(CreateFeedbackMotelRequest $request)
    {
        $input = $request->all();

        $feedbackMotel = $this->feedbackMotelRepository->create($input);

        Flash::success('Feedback Motel saved successfully.');

        return redirect(route('admin.feedbackMotels.index'));
    }

    /**
     * Display the specified FeedbackMotel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $feedbackMotel = $this->feedbackMotelRepository->findWithoutFail($id);

        if (empty($feedbackMotel)) {
            Flash::error('Feedback Motel not found');

            return redirect(route('admin.feedbackMotels.index'));
        }

        return view('backend.feedback_motels.show')->with('feedbackMotel', $feedbackMotel);
    }

    /**
     * Show the form for editing the specified FeedbackMotel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $feedbackMotel = $this->feedbackMotelRepository->findWithoutFail($id);

        if (empty($feedbackMotel)) {
            Flash::error('Feedback Motel not found');

            return redirect(route('admin.feedbackMotels.index'));
        }

        return view('backend.feedback_motels.edit')->with('feedbackMotel', $feedbackMotel);
    }

    /**
     * Update the specified FeedbackMotel in storage.
     *
     * @param  int              $id
     * @param UpdateFeedbackMotelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFeedbackMotelRequest $request)
    {
        $feedbackMotel = $this->feedbackMotelRepository->findWithoutFail($id);

        if (empty($feedbackMotel)) {
            Flash::error('Feedback Motel not found');

            return redirect(route('admin.feedbackMotels.index'));
        }

        $feedbackMotel = $this->feedbackMotelRepository->update($request->all(), $id);

        Flash::success('Feedback Motel updated successfully.');

        return redirect(route('admin.feedbackMotels.index'));
    }

    /**
     * Remove the specified FeedbackMotel from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $feedbackMotel = $this->feedbackMotelRepository->findWithoutFail($id);

        if (empty($feedbackMotel)) {
            Flash::error('Feedback Motel not found');

            return redirect(route('admin.feedbackMotels.index'));
        }

        $this->feedbackMotelRepository->delete($id);

        Flash::success('Feedback Motel deleted successfully.');

        return redirect(route('admin.feedbackMotels.index'));
    }
}

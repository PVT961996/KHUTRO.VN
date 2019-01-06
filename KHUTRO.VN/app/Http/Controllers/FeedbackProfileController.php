<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFeedbackProfileRequest;
use App\Http\Requests\UpdateFeedbackProfileRequest;
use App\Repositories\FeedbackProfileRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class FeedbackProfileController extends AppBaseController
{
    /** @var  FeedbackProfileRepository */
    private $feedbackProfileRepository;

    public function __construct(FeedbackProfileRepository $feedbackProfileRepo)
    {
        $this->feedbackProfileRepository = $feedbackProfileRepo;
    }

    /**
     * Display a listing of the FeedbackProfile.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->feedbackProfileRepository->pushCriteria(new RequestCriteria($request));
        $feedbackProfiles = $this->feedbackProfileRepository->all();

        return view('backend.feedback_profiles.index')
            ->with('feedbackProfiles', $feedbackProfiles);
    }

    /**
     * Show the form for creating a new FeedbackProfile.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.feedback_profiles.create');
    }

    /**
     * Store a newly created FeedbackProfile in storage.
     *
     * @param CreateFeedbackProfileRequest $request
     *
     * @return Response
     */
    public function store(CreateFeedbackProfileRequest $request)
    {
        $input = $request->all();

        $feedbackProfile = $this->feedbackProfileRepository->create($input);

        Flash::success('Feedback Profile saved successfully.');

        return redirect(route('admin.feedbackProfiles.index'));
    }

    /**
     * Display the specified FeedbackProfile.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $feedbackProfile = $this->feedbackProfileRepository->findWithoutFail($id);

        if (empty($feedbackProfile)) {
            Flash::error('Feedback Profile not found');

            return redirect(route('admin.feedbackProfiles.index'));
        }

        return view('backend.feedback_profiles.show')->with('feedbackProfile', $feedbackProfile);
    }

    /**
     * Show the form for editing the specified FeedbackProfile.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $feedbackProfile = $this->feedbackProfileRepository->findWithoutFail($id);

        if (empty($feedbackProfile)) {
            Flash::error('Feedback Profile not found');

            return redirect(route('admin.feedbackProfiles.index'));
        }

        return view('backend.feedback_profiles.edit')->with('feedbackProfile', $feedbackProfile);
    }

    /**
     * Update the specified FeedbackProfile in storage.
     *
     * @param  int              $id
     * @param UpdateFeedbackProfileRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFeedbackProfileRequest $request)
    {
        $feedbackProfile = $this->feedbackProfileRepository->findWithoutFail($id);

        if (empty($feedbackProfile)) {
            Flash::error('Feedback Profile not found');

            return redirect(route('admin.feedbackProfiles.index'));
        }

        $feedbackProfile = $this->feedbackProfileRepository->update($request->all(), $id);

        Flash::success('Feedback Profile updated successfully.');

        return redirect(route('admin.feedbackProfiles.index'));
    }

    /**
     * Remove the specified FeedbackProfile from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $feedbackProfile = $this->feedbackProfileRepository->findWithoutFail($id);

        if (empty($feedbackProfile)) {
            Flash::error('Feedback Profile not found');

            return redirect(route('admin.feedbackProfiles.index'));
        }

        $this->feedbackProfileRepository->delete($id);

        Flash::success('Feedback Profile deleted successfully.');

        return redirect(route('admin.feedbackProfiles.index'));
    }
}

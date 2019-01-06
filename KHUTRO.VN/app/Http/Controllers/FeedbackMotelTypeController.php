<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFeedbackMotelTypeRequest;
use App\Http\Requests\UpdateFeedbackMotelTypeRequest;
use App\Repositories\FeedbackMotelTypeRepository;
use Illuminate\Http\Request;
use Flash;
use Response;

class FeedbackMotelTypeController extends AppBaseController
{
    /** @var  FeedbackMotelTypeRepository */
    private $feedbackMotelTypeRepository;

    public function __construct(FeedbackMotelTypeRepository $feedbackMotelTypeRepo)
    {
        $this->feedbackMotelTypeRepository = $feedbackMotelTypeRepo;
    }

    /**
     * Display a listing of the FeedbackMotelType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search=$request->search;
        if(!empty($search)){
            $feedbackMotelTypes=$this->feedbackMotelTypeRepository->findByField('name','LIKE','%'.$search['name'].'%',['*'],true,5);
        }
        else{
            $feedbackMotelTypes = $this->feedbackMotelTypeRepository->paginate(5);
        }

        return view('backend.feedback_motel_types.index')
            ->with('feedbackMotelTypes', $feedbackMotelTypes);
    }

    /**
     * Show the form for creating a new FeedbackMotelType.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.feedback_motel_types.create');
    }

    /**
     * Store a newly created FeedbackMotelType in storage.
     *
     * @param CreateFeedbackMotelTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateFeedbackMotelTypeRequest $request)
    {
        $input = $request->all();

        $feedbackMotelType = $this->feedbackMotelTypeRepository->create($input);

        Flash::success(__('messages.feedback_motel_types_saved'));
        if($input['save']==='save_edit'){
            return redirect(route('admin.feedbackMotelTypes.edit', $feedbackMotelType->id));
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.feedbackMotelTypes.create'));
        }
        else{
            return redirect(route('admin.feedbackMotelTypes.index'));
        }
    }

    /**
     * Display the specified FeedbackMotelType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $feedbackMotelType = $this->feedbackMotelTypeRepository->findWithoutFail($id);

        if (empty($feedbackMotelType)) {
            Flash::error(__('messages.feedback_motel_types_not_found'));

            return redirect(route('admin.feedbackMotelTypes.index'));
        }

        return view('backend.feedback_motel_types.show')->with('feedbackMotelType', $feedbackMotelType);
    }

    /**
     * Show the form for editing the specified FeedbackMotelType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $feedbackMotelType = $this->feedbackMotelTypeRepository->findWithoutFail($id);

        if (empty($feedbackMotelType)) {
            Flash::error(__('messages.feedback_motel_types_not_found'));

            return redirect(route('admin.feedbackMotelTypes.index'));
        }

        return view('backend.feedback_motel_types.edit')->with('feedbackMotelType', $feedbackMotelType);
    }

    /**
     * Update the specified FeedbackMotelType in storage.
     *
     * @param  int              $id
     * @param UpdateFeedbackMotelTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFeedbackMotelTypeRequest $request)
    {
        $feedbackMotelType = $this->feedbackMotelTypeRepository->findWithoutFail($id);

        if (empty($feedbackMotelType)) {
            Flash::error(__('messages.feedback_motel_types_not_found'));

            return redirect(route('admin.feedbackMotelTypes.index'));
        }
        $input = $request->all();
        $feedbackMotelType = $this->feedbackMotelTypeRepository->update($input, $id);

        Flash::success(__('messages.feedback_motel_types_updated'));
        if($input['save']==='save_edit'){
            return redirect(route('admin.feedbackMotelTypes.edit',$feedbackMotelType->id));
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.feedbackMotelTypes.create'));
        }
        else{
            return redirect(route('admin.feedbackMotelTypes.index'));
        }
    }

    /**
     * Remove the specified FeedbackMotelType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    private function checkfeedbackMotelTypes($ids){
        foreach ($ids as $id){
            $feedbackMotelType = $this->feedbackMotelTypeRepository->findWithoutFail($id);
            if (empty($feedbackMotelType)) {
                return false;
            }
        }
        return true;
    }

    public function destroy($id, Request $request)
    {
        if($id=='MULTI'){
            if($request->ids!=null){
                // Neu xuat hien loi khong xoa gi ca. Đưa ra lỗi
                if($this->checkfeedbackMotelTypes($request->ids)){
                    $this->feedbackMotelTypeRepository->destroy_multiple($request->ids);
                    Flash::success(__('messages.feedback_motel_types_deleted'));
                }
                else{
                    Flash::error(__('messages.feedback_motel_types_not_found '));
                }
                return redirect(route('admin.feedbackMotelTypes.index'));
            }
            else{
                Flash::error(__('messages.no_value_select'));
                return redirect(route('admin.feedbackMotelTypes.index'));
            }
        }
        else{
            $feedbackMotelType = $this->feedbackMotelTypeRepository->findWithoutFail($id);
            if (empty($feedbackMotelType)) {
                Flash::error(__('messages.feedback_motel_types_not_found'));

                return redirect(route('admin.feedbackMotelTypes.index'));
            }
            $this->feedbackMotelTypeRepository->delete($id);
            Flash::success(__('messages.feedback_motel_types_deleted'));
            return redirect(route('admin.feedbackMotelTypes.index'));
        }
    }

    public function export(){
        return;
    }
}

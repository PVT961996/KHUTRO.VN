<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateConfigPriceRequest;
use App\Http\Requests\UpdateConfigPriceRequest;
use App\Repositories\ConfigPriceRepository;
use Illuminate\Http\Request;
use Flash;
use Response;

class ConfigPriceController extends AppBaseController
{

    private $configPriceRepository;
    public function __construct(ConfigPriceRepository $configPriceRepo)
    {
        $this->configPriceRepository = $configPriceRepo;
    }

    /**
     * Display a listing of the ConfigPrice.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search=$request->search;
        if(!empty($search)){
            $configPrices=$this->configPriceRepository->findByField('name','LIKE','%'.$search['name'].'%',['*'],true,10);
        }
        else{
            $configPrices = $this->configPriceRepository->paginate(10);
        }

        return view('backend.config_prices.index')
            ->with('configPrices', $configPrices);

    }

    /**
     * Show the form for creating a new ConfigPrice.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.config_prices.create');
    }

    /**
     * Store a newly created ConfigPrice in storage.
     *
     * @param CreateConfigPriceRequest $request
     *
     * @return Response
     */
    public function store(CreateConfigPriceRequest $request)
    {
        $input = $request->all();
        $configPrice = $this->configPriceRepository->create($input);

        Flash::success(__("messages.config_price_add_successfully"));
        if($input['save']==='save_edit'){
            return redirect(route('admin.configPrices.edit', $configPrice->id));
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.configPrices.create'));
        }
        else{
            return redirect(route('admin.configPrices.index'));
        }
    }

    /**
     * Display the specified ConfigPrice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $configPrice = $this->configPriceRepository->findWithoutFail($id);

        if (empty($configPrice)) {
            Flash::error(__("messages.config_price_not_found"));

            return redirect(route('admin.configPrices.index'));
        }

        return view('backend.config_prices.show')->with('configPrice', $configPrice);
    }

    /**
     * Show the form for editing the specified ConfigPrice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $configPrice = $this->configPriceRepository->findWithoutFail($id);

        if (empty($configPrice)) {
            Flash::error(__("messages.config_price_not_found"));

            return redirect(route('admin.configPrices.index'));
        }

        return view('backend.config_prices.edit')->with('configPrice', $configPrice);
    }

    /**
     * Update the specified ConfigPrice in storage.
     *
     * @param  int              $id
     * @param UpdateConfigPriceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConfigPriceRequest $request)
    {
        $configPrice = $this->configPriceRepository->findWithoutFail($id);

        if (empty($configPrice)) {
            Flash::error(__("messages.config_price_not_found"));

            return redirect(route('admin.configPrices.index'));
        }

        $configPrice = $this->configPriceRepository->update($request->all(), $id);

        Flash::success(__("messages.config_price_updated"));
        if($request->all()['save']==='save_edit'){
            return redirect(route('admin.configPrices.edit', $configPrice->id));
        }
        elseif ($request->all()['save']==='save_new'){
            return redirect(route('admin.configPrices.create'));
        }
        else{
            return redirect(route('admin.configPrices.index'));
        }
    }

    /**
     * Remove the specified ConfigPrice from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    private function checkconfigPrices($ids){
        foreach ($ids as $id){
            $configPrice = $this->configPriceRepository->findWithoutFail($id);
            if (empty($configPrice)) {
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
                if($this->checkconfigPrices($request->ids)){
                    $this->configPriceRepository->destroy_multiple($request->ids);
                    Flash::success(__("messages.config_price_deleted"));
                }
                else{
                    Flash::error(__("messages.config_price_not_found"));
                }
                return redirect(route('admin.configPrices.index'));
            }
            else{
                Flash::error(__("messages.no_value_select"));
                return redirect(route('admin.configPrices.index'));
            }
        }
        else{
            $configPrice = $this->configPriceRepository->findWithoutFail($id);
            if (empty($configPrice)) {
                Flash::error(__("messages.config_price_not_found"));
                return redirect(route('admin.configPrices.index'));
            }
            $this->configPriceRepository->delete($id);
            Flash::success(__("messages.config_price_deleted"));
            return redirect(route('admin.configPrices.index'));
        }

    }

    public function duplicate($id){
        $configPrice = $this->configPriceRepository->findWithoutFail($id);
        if (empty($configPrice)) {
            Flash::error(__('messages.config_price_not_found'));
            return redirect(route('admin.configPrices.index'));
        }
        $type = 'DUPLICATE';
        return view('backend.configPrices.edit', compact('type'))->with('configPrice', $configPrice);
    }

    public function exportToFile(Request $request){
        return;
    }
}

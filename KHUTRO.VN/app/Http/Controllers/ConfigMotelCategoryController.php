<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateConfigMotelCategoryRequest;
use App\Http\Requests\UpdateConfigMotelCategoryRequest;
use App\Repositories\ConfigMotelCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ConfigMotelCategoryController extends AppBaseController
{
    /** @var  ConfigMotelCategoryRepository */
    private $configMotelCategoryRepository;

    public function __construct(ConfigMotelCategoryRepository $configMotelCategoryRepo)
    {
        $this->configMotelCategoryRepository = $configMotelCategoryRepo;
    }

    /**
     * Display a listing of the ConfigMotelCategory.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->configMotelCategoryRepository->pushCriteria(new RequestCriteria($request));
        $configMotelCategories = $this->configMotelCategoryRepository->all();

        return view('backend.config_motel_categories.index')
            ->with('configMotelCategories', $configMotelCategories);
    }

    /**
     * Show the form for creating a new ConfigMotelCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.config_motel_categories.create');
    }

    /**
     * Store a newly created ConfigMotelCategory in storage.
     *
     * @param CreateConfigMotelCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateConfigMotelCategoryRequest $request)
    {
        $input = $request->all();

        $configMotelCategory = $this->configMotelCategoryRepository->create($input);

        Flash::success('Config Motel Category saved successfully.');

        return redirect(route('admin.configMotelCategories.index'));
    }

    /**
     * Display the specified ConfigMotelCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $configMotelCategory = $this->configMotelCategoryRepository->findWithoutFail($id);

        if (empty($configMotelCategory)) {
            Flash::error('Config Motel Category not found');

            return redirect(route('admin.configMotelCategories.index'));
        }

        return view('backend.config_motel_categories.show')->with('configMotelCategory', $configMotelCategory);
    }

    /**
     * Show the form for editing the specified ConfigMotelCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $configMotelCategory = $this->configMotelCategoryRepository->findWithoutFail($id);

        if (empty($configMotelCategory)) {
            Flash::error('Config Motel Category not found');

            return redirect(route('admin.configMotelCategories.index'));
        }

        return view('backend.config_motel_categories.edit')->with('configMotelCategory', $configMotelCategory);
    }

    /**
     * Update the specified ConfigMotelCategory in storage.
     *
     * @param  int              $id
     * @param UpdateConfigMotelCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConfigMotelCategoryRequest $request)
    {
        $configMotelCategory = $this->configMotelCategoryRepository->findWithoutFail($id);

        if (empty($configMotelCategory)) {
            Flash::error('Config Motel Category not found');

            return redirect(route('admin.configMotelCategories.index'));
        }

        $configMotelCategory = $this->configMotelCategoryRepository->update($request->all(), $id);

        Flash::success('Config Motel Category updated successfully.');

        return redirect(route('admin.configMotelCategories.index'));
    }

    /**
     * Remove the specified ConfigMotelCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $configMotelCategory = $this->configMotelCategoryRepository->findWithoutFail($id);

        if (empty($configMotelCategory)) {
            Flash::error('Config Motel Category not found');

            return redirect(route('admin.configMotelCategories.index'));
        }

        $this->configMotelCategoryRepository->delete($id);

        Flash::success('Config Motel Category deleted successfully.');

        return redirect(route('admin.configMotelCategories.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTableRequest;
use App\Http\Requests\UpdateTableRequest;
use App\Models\Menu;
use App\Repositories\TableRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Repositories\ActionRepository;
use App\Repositories\MenuRepository;
use Maatwebsite\Excel\Facades\Excel;


class TableController extends AppBaseController
{
    /** @var  TableRepository */
    private $tableRepository;
    private $actionRepository;
    private $menuRepository;

    public function __construct(TableRepository $tableRepo, ActionRepository $actionRepo, MenuRepository $menuRepo)
    {
        $this->tableRepository = $tableRepo;
        $this->actionRepository = $actionRepo;
        $this->menuRepository = $menuRepo;
    }

    /**
     * Display a listing of the Table.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $searchCondition = [];
        if (!empty($search)) {
            if (!empty($search['name'])) {
                array_push($searchCondition, ['name', 'LIKE', '%' . $search['name'] . '%']);
            }
            $tables = $this->tableRepository->findWhere($searchCondition, ['*'], true, 10);
        } else {
            $tables = $this->tableRepository->paginate(10);
        }

        return view('backend.tables.index')
            ->with('tables', $tables);
    }

    /**
     * Show the form for creating a new Table.
     *
     * @return Response
     */
    public function create()
    {
        $actions = $this->actionRepository->all();
        return view('backend.tables.create', compact('actions'));
    }

    /**
     * Store a newly created Table in storage.
     *
     * @param CreateTableRequest $request
     *
     * @return Response
     */
    public function store(CreateTableRequest $request)
    {
        $input = $request->all();
        $table = $this->tableRepository->create($input);

        Flash::success('Table saved successfully.');

        /*For relationship beetween TABLES and ACTIONS*/
        $action_ids = $request->action_ids;
        if (!empty($action_ids)) {
            foreach ($action_ids as $action_id) {
                $menu = new Menu();
                $menu->action_id = $action_id;
                $menu->table_id = $table->id;
                $menu->save();
            }
        };

        if ($input['save'] === 'save_edit') {
            return redirect(route('admin.tables.edit', $table->id));
        } elseif ($input['save'] === 'save_new') {
            return redirect(route('admin.tables.create'));
        } else {
            return redirect(route('admin.tables.index'));
        }
    }

    /**
     * Display the specified Table.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $table = $this->tableRepository->findWithoutFail($id);

        if (empty($table)) {
            Flash::error('Table not found');

            return redirect(route('admin.tables.index'));
        }

        return view('backend.tables.show')->with('table', $table);
    }

    /**
     * Show the form for editing the specified Table.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $table = $this->tableRepository->findWithoutFail($id);

        if (empty($table)) {
            Flash::error('Table not found');

            return redirect(route('admin.tables.index'));
        }

        $actions = $this->actionRepository->all();
        $current_action_ids = $table->actions->pluck('id');
        return view('backend.tables.edit', compact('actions', 'current_action_ids'))->with('table', $table);

    }

    /**
     * Update the specified Table in storage.
     *
     * @param  int $id
     * @param UpdateTableRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTableRequest $request)
    {
        $input = $request->all();
        $table = $this->tableRepository->findWithoutFail($id);

        if (empty($table)) {
            Flash::error('Table not found');

            return redirect(route('admin.tables.index'));
        }

        $table = $this->tableRepository->update($request->all(), $id);

        /*For relationship beetween TABLES and ACTIONS*/
        $action_ids = $request->action_ids;
        $table->actions()->sync($action_ids);

        Flash::success('Table updated successfully.');

        if ($input['save'] === 'save_edit') {
            return back()->withInput();
        } elseif ($input['save'] === 'save_new') {
            return redirect(route('admin.tables.create'));
        } else {

            return redirect(route('admin.tables.index'));
        }
    }

    /**
     * Remove the specified Table from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        if ($id == 'MULTI') {
            $ids = $request->ids;
            if (empty($ids)) {
                Flash::warning(__('No value is selected. Check again!'));
            } else {

                /*Delete related menu for this table*/
                foreach ($ids as $id) {
                    $menus_related = $this->menuRepository->findWhere([['table_id', '=', $id]]);
                    foreach ($menus_related as $menu_related) {
                        $this->menuRepository->delete($menu_related->id);
                    }
                }

                $this->tableRepository->destroy_multiple($ids);
                Flash::success('Table deleted successfully.');
            }

            return redirect(route('admin.tables.index'));
        } else {
            $table = $this->tableRepository->findWithoutFail($id);

            if (empty($table)) {
                Flash::error('Table not found');

                return redirect(route('admin.tables.index'));
            }

            /*Delete related menu for this table*/
            $menus_related = $this->menuRepository->findWhere([['table_id', '=', $id]]);
            foreach ($menus_related as $menu_related) {
                $this->menuRepository->delete($menu_related->id);
            }

            $this->tableRepository->delete($id);

            Flash::success('Table deleted successfully.');

            return redirect(route('admin.tables.index'));
        }
    }

    public function exportExcel(Request $request)
    {
        $type = $request->type;
        $tables = $this->tableRepository->all();
        $data = $tables->toArray();
        if ($type == 'xls') {
            Excel::create('Filename', function ($excel) use ($data) {

                $excel->sheet('Sheetname', function ($sheet) use ($data) {

                    $sheet->fromArray($data);

                });

            })->export('xls');
        } elseif ($type == 'csv') {
            Excel::create('Filename', function ($excel) use ($data) {

                $excel->sheet('Sheetname', function ($sheet) use ($data) {

                    $sheet->fromArray($data);

                });

            })->export('csv');
        }
    }

    public function duplicate($id)
    {
        $table = $this->tableRepository->findWithoutFail($id);

        if (empty($table)) {
            Flash::error('Table not found');

            return redirect(route('admin.tables.index'));
        }

        $actions = $this->actionRepository->all();
        $current_action_ids = $table->actions->pluck('id');
        $type = 'DUPLICATE';
        return view('backend.tables.edit', compact('actions', 'current_action_ids', 'type'))->with('table', $table);
    }
}

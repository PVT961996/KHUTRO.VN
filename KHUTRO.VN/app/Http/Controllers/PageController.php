<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Repositories\PageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class PageController extends AppBaseController
{
    /** @var  PageRepository */
    private $pageRepository;

    public function __construct(PageRepository $pageRepo)
    {
        $this->pageRepository = $pageRepo;
    }

    /**
     * Display a listing of the Page.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $searchCondition = [];
        if (!empty($search)) {
            if (!empty($search['title'])) {
                array_push($searchCondition, ['title', 'LIKE', '%' . $search['title'] . '%']);
            }
            $pages = $this->pageRepository->findWhere($searchCondition, ['*'], true, 10);
        } else {
            $pages = $this->pageRepository->paginate(10);
        }

        return view('backend.pages.index')
            ->with('pages', $pages);
    }

    /**
     * Show the form for creating a new Page.
     *
     * @return Response
     */
    public function create()
    {
        $pages = $this->pageRepository->buildTreeForSelectBox('title', ['*'], '-');
        return view('backend.pages.create', compact('pages'));
    }

    /**
     * Store a newly created Page in storage.
     *
     * @param CreatePageRequest $request
     *
     * @return Response
     */
    public function store(CreatePageRequest $request)
    {
        $input = $request->all();
        if ($input['parent_id'] == 0) {
            $input['parent_id'] = null;
        }
        $page = $this->pageRepository->create($input);
        if ($page->parent_id == '') {
            $page->parent_id = $page->id;
        }

        $page->user_id = Auth::user()->id;
        $page->content = $request->page_content;
        $page->save();

        Flash::success('Page saved successfully.');

        if ($input['save'] === 'SAVE_EDIT') {
            return redirect(route('admin.pages.edit', $page->id));
        } elseif ($input['save'] === 'SAVE_NEW') {
            return redirect(route('admin.pages.create'));
        } else {
            return redirect(route('admin.pages.index'));
        }
    }

    /**
     * Display the specified Page.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $page = $this->pageRepository->findWithoutFail($id);

        if (empty($page)) {
            Flash::error('Page not found');

            return redirect(route('admin.pages.index'));
        }

        return view('backend.pages.show')->with('page', $page);
    }

    /**
     * Show the form for editing the specified Page.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $page = $this->pageRepository->findWithoutFail($id);
        $pages = $this->pageRepository->buildTreeForSelectBox('title', ['*'], '-', $id);
        $parent_id = $page->id;
        if ($page->parent_id != $page->id) {
            $parent_id = $page->parent_id;
        }
        if (empty($page)) {
            Flash::error('Page not found');

            return redirect(route('admin.pages.index'));
        }

        return view('backend.pages.edit', compact('pages', 'parent_id'))->with('page', $page);
    }

    /**
     * Update the specified Page in storage.
     *
     * @param  int $id
     * @param UpdatePageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePageRequest $request)
    {
        $page = $this->pageRepository->findWithoutFail($id);

        if (empty($page)) {
            Flash::error('Page not found');

            return redirect(route('admin.pages.index'));
        }

        $input = $request->all();
        if ($input['parent_id'] == 0) {
            $input['parent_id'] = null;
        }

        $page = $this->pageRepository->update($input, $id);
        if ($page->parent_id == '') {
            $page->parent_id = $page->id;
        }
        $page->content = $request->page_content;
        $page->save();

        Flash::success('Page updated successfully.');

        if ($input['save'] === 'SAVE_EDIT') {

            return back()->withInput();
        } elseif ($input['save'] === 'SAVE_NEW') {

            return redirect(route('admin.pages.create'));
        } else {

            return redirect(route('admin.pages.index'));
        }
    }

    /**
     * Remove the specified Page from storage.
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
                foreach ($ids as $id) {
                    $page = $this->pageRepository->findWithoutFail($id);
                    if (count($page->children()) > 1) {
                        $message = 'Can not delete because ' . $page->title . ' page contains children page. Check again!';
                        Flash::warning($message);
                        return redirect(route('admin.pages.index'));
                    }
                }
                $this->pageRepository->destroy_multiple($ids);
                Flash::success('Page deleted successfully.');
            }
        } else {
            $page = $this->pageRepository->findWithoutFail($id);

            if (empty($page)) {
                Flash::error('Page not found');

                return redirect(route('admin.pages.index'));
            }
            if (count($page->children()) > 1) {
                Flash::warning('Can not delete page because it contains children page.');
            } else {
                $this->pageRepository->delete($id);
                Flash::success('Page deleted successfully.');
            }
        }
        return redirect(route('admin.pages.index'));

    }

    public function duplicate($id)
    {
        $page = $this->pageRepository->findWithoutFail($id);
        $pages = $this->pageRepository->buildTreeForSelectBox('title', ['*'], '-', $id);
        $parent_id = $page->id;
        if ($page->parent_id != $page->id) {
            $parent_id = $page->parent_id;
        }
        if (empty($page)) {
            Flash::error('Page not found');

            return redirect(route('admin.pages.index'));
        }

        $type = 'DUPLICATE';

        return view('backend.pages.edit', compact('type', 'pages', 'parent_id'))->with('page', $page);
    }

    public function common_action(Request $request)
    {
        $submit_type = $request->submit_type;
        if ($submit_type == 'DELETE_MULTI') {
            $this->destroy('MULTI', $request);
        }
        return redirect(route('admin.pages.index'));
    }
}

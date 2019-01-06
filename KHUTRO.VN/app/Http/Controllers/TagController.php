<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Repositories\PostRepository;
use App\Repositories\PostTagRepository;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TagController extends AppBaseController
{
    /** @var  TagRepository */
    private $tagRepository;
    private $postRepository;
    private $postTagRepository;
    public function __construct(TagRepository $tagRepo,PostRepository $postRepo,PostTagRepository $postTagRepo)
    {
        $this->tagRepository = $tagRepo;
        $this->postRepository = $postRepo;
        $this->postTagRepository = $postTagRepo;
    }

    /**
     * Display a listing of the Tag.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search=$request->search;
        if(!empty($search)){
            $tags=$this->tagRepository->findByField('name','LIKE','%'.$search['name'].'%',['*'],true,10);
        }
        else{
            $this->tagRepository->pushCriteria(new RequestCriteria($request));
            $tags = $this->tagRepository->paginate(10);
        }

        return view('backend.tags.index')
            ->with('tags', $tags);
    }

    /**
     * Show the form for creating a new Tag.
     *
     * @return Response
     */
    public function create()
    {
        $posts= $this->postRepository->all();
        return view('backend.tags.create',compact('posts'));
    }

    /**
     * Store a newly created Tag in storage.
     *
     * @param CreateTagRequest $request
     *
     * @return Response
     */
    public function store(CreateTagRequest $request)
    {

        $input = $request->all();
        $tag = $this->tagRepository->create($input);
        $post_ids = $request->post_ids;
        $tag->posts()->sync($post_ids);

        Flash::success('Tag saved successfully.');

        if($input['save']==='save_edit'){
            return redirect(route('admin.tags.edit', $tag->id));
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.tags.create'));
        }
        else{
            return redirect(route('admin.tags.index'));
        }
    }

    /**
     * Display the specified Tag.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tag = $this->tagRepository->findWithoutFail($id);

        if (empty($tag)) {
            Flash::error('Tag not found');

            return redirect(route('admin.tags.index'));
        }

        return view('backend.tags.show')->with('tag', $tag);
    }

    /**
     * Show the form for editing the specified Tag.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tag = $this->tagRepository->findWithoutFail($id);
        if (empty($tag)) {
            Flash::error('Tag not found');

            return redirect(route('admin.tags.index'));
        }
        $posts = $this->postRepository->all();

        $current_post_ids = $tag->posts;
//        dd(count($current_post_ids));
        return view('backend.tags.edit',compact('current_post_ids','posts'))->with('tag', $tag);
    }

    /**
     * Update the specified Tag in storage.
     *
     * @param  int              $id
     * @param UpdateTagRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTagRequest $request)
    {
        $input = $request->all();
        $tag = $this->tagRepository->findWithoutFail($id);
        if (empty($tag)) {
            Flash::error('Tag not found');
            return redirect(route('admin.tags.index'));
        }
        $tag = $this->tagRepository->update($input, $id);
        $posts_ids = $request->post_ids;
        $tag->posts()->sync($posts_ids);
        Flash::success('Tag saved successfully.');
        if($input['save']==='save_edit'){
            return back()->withInput();
        }
        elseif ($input['save']==='save_new'){
            return redirect(route('admin.tags.create'));
        }
        else{
            return redirect(route('admin.tags.index'));
        }
    }

    /**
     * Remove the specified Tag from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    private function checkTags($ids){
        foreach ($ids as $id){
            $tag = $this->tagRepository->findWithoutFail($id);
            if (empty($tag)) {
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
                if($this->checkTags($request->ids)){
                    $this->tagRepository->destroy_multiple($request->ids);
                    Flash::success('Tag deleted successfully.');
                }
                else{
                    Flash::error('Tag not found');
                }
                return redirect(route('admin.tags.index'));
            }
            else{
                Flash::error('Chọn mục để xóa!');
                return redirect(route('admin.tags.index'));
            }
        }
        else{
            $tag = $this->tagRepository->findWithoutFail($id);
            if (empty($tag)) {
                Flash::error('Tag not found');

                return redirect(route('admin.tags.index'));
            }
            $this->tagRepository->delete($id);
            Flash::success('Tag deleted successfully.');
            return redirect(route('admin.tags.index'));
        }

    }

    public function duplicate($id){
        $tag = $this->tagRepository->findWithoutFail($id);
        $posts=$this->postRepository->all();
        $current_post_ids = $tag->posts;
        if (empty($tag)) {
            Flash::error('Tag not found');
            return redirect(route('admin.tags.index'));
        }
//        dd($tag->name);
        $type = 'DUPLICATE';
//        return redirect(route('admin.tags.edit',$tag))->with('type', $type);
        return view('backend.tags.edit', compact('type','posts','current_post_ids'))->with('tag', $tag);
    }

    public function exportExcel(Request $request)
    {
        dd($request->search);
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
}



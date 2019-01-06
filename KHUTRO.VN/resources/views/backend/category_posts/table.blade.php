<table class="table table-responsive" id="categoryPosts-table">
    <thead>
        <th>Post Category Id</th>
        <th>Post Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($categoryPosts as $categoryPost)
        <tr>
            <td>{!! $categoryPost->post_category_id !!}</td>
            <td>{!! $categoryPost->post_id !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.categoryPosts.destroy', $categoryPost->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.categoryPosts.show', [$categoryPost->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.categoryPosts.edit', [$categoryPost->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".Lang::get('messages.are_you_sure')."')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
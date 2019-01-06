<table class="table table-responsive" id="commentPosts-table">
    <thead>
        <th>User Id</th>
        <th>Post Id</th>
        <th>Parent Id</th>
        <th>Content</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($commentPosts as $commentPost)
        <tr>
            <td>{!! $commentPost->user_id !!}</td>
            <td>{!! $commentPost->post_id !!}</td>
            <td>{!! $commentPost->parent_id !!}</td>
            <td>{!! $commentPost->content !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.commentPosts.destroy', $commentPost->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.commentPosts.show', [$commentPost->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.commentPosts.edit', [$commentPost->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".Lang::get('messages.are_you_sure')."')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
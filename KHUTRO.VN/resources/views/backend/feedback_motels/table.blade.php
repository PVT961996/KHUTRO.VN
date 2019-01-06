<table class="table table-responsive" id="feedbackMotels-table">
    <thead>
        <th>User Id</th>
        <th>Motel Id</th>
        <th>Feedback Type</th>
        <th>Content</th>
        <th>Phone Number</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($feedbackMotels as $feedbackMotel)
        <tr>
            <td>{!! $feedbackMotel->user_id !!}</td>
            <td>{!! $feedbackMotel->motel_id !!}</td>
            <td>{!! $feedbackMotel->feedback_type !!}</td>
            <td>{!! $feedbackMotel->content !!}</td>
            <td>{!! $feedbackMotel->phone_number !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.feedbackMotels.destroy', $feedbackMotel->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.feedbackMotels.show', [$feedbackMotel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.feedbackMotels.edit', [$feedbackMotel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".Lang::get('messages.are_you_sure')."')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
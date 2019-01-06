<table class="table table-responsive" id="feedbackProfiles-table">
    <thead>
        <th>User Id</th>
        <th>Profile Id</th>
        <th>Parent Id</th>
        <th>Content</th>
        <th>Rate Score</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($feedbackProfiles as $feedbackProfile)
        <tr>
            <td>{!! $feedbackProfile->user_id !!}</td>
            <td>{!! $feedbackProfile->profile_id !!}</td>
            <td>{!! $feedbackProfile->parent_id !!}</td>
            <td>{!! $feedbackProfile->content !!}</td>
            <td>{!! $feedbackProfile->rate_score !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.feedbackProfiles.destroy', $feedbackProfile->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.feedbackProfiles.show', [$feedbackProfile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.feedbackProfiles.edit', [$feedbackProfile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".Lang::get('messages.are_you_sure')."')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<table class="table table-responsive" id="userGroups-table">
    <thead>
        <th>@lang('messages.user')</th>
        <th>@lang('messages.group')</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($userGroups as $userGroup)
        <tr>
            <td>{!! $userGroup->user->name !!}</td>
            <td>{!! $userGroup->group->name !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.userGroups.destroy', $userGroup->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.userGroups.show', [$userGroup->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.userGroups.edit', [$userGroup->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
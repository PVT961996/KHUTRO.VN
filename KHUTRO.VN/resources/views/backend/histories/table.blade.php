<table class="table table-responsive" id="histories-table">
    <thead>
        <th>User Id</th>
        <th>Menu Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($histories as $history)
        <tr>
            <td>{!! $history->user_id !!}</td>
            <td>{!! $history->menu_id !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.histories.destroy', $history->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.histories.show', [$history->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.histories.edit', [$history->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
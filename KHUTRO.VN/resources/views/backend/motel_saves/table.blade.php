<table class="table table-responsive" id="motelSaves-table">
    <thead>
        <th>User Id</th>
        <th>Motel Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($motelSaves as $motelSave)
        <tr>
            <td>{!! $motelSave->user_id !!}</td>
            <td>{!! $motelSave->motel_id !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.motelSaves.destroy', $motelSave->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.motelSaves.show', [$motelSave->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.motelSaves.edit', [$motelSave->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
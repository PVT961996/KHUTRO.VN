<table class="table table-responsive" id="deviceMotels-table">
    <thead>
        <th>Device Id</th>
        <th>Motel Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($deviceMotels as $deviceMotel)
        <tr>
            <td>{!! $deviceMotel->device_id !!}</td>
            <td>{!! $deviceMotel->motel_id !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.deviceMotels.destroy', $deviceMotel->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.deviceMotels.show', [$deviceMotel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.deviceMotels.edit', [$deviceMotel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
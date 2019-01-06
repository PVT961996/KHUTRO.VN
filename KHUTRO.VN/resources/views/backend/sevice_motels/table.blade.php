<table class="table table-responsive" id="seviceMotels-table">
    <thead>
        <th>Sevice Id</th>
        <th>Motel Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($seviceMotels as $seviceMotel)
        <tr>
            <td>{!! $seviceMotel->sevice_id !!}</td>
            <td>{!! $seviceMotel->motel_id !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.seviceMotels.destroy', $seviceMotel->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.seviceMotels.show', [$seviceMotel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.seviceMotels.edit', [$seviceMotel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
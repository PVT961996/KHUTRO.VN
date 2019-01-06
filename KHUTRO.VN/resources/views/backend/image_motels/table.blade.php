<table class="table table-responsive" id="imageMotels-table">
    <thead>
        <th>Image</th>
        <th>Motel Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($imageMotels as $imageMotel)
        <tr>
            <td>{!! $imageMotel->image !!}</td>
            <td>{!! $imageMotel->motel_id !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.imageMotels.destroy', $imageMotel->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.imageMotels.show', [$imageMotel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.imageMotels.edit', [$imageMotel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
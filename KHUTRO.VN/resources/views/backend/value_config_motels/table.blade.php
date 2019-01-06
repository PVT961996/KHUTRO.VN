<table class="table table-responsive" id="valueConfigMotels-table">
    <thead>
        <th>Config Category Id</th>
        <th>Value</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($valueConfigMotels as $valueConfigMotel)
        <tr>
            <td>{!! $valueConfigMotel->config_category_id !!}</td>
            <td>{!! $valueConfigMotel->value !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.valueConfigMotels.destroy', $valueConfigMotel->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.valueConfigMotels.show', [$valueConfigMotel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.valueConfigMotels.edit', [$valueConfigMotel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
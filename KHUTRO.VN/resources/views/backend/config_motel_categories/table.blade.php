<table class="table table-responsive" id="configMotelCategories-table">
    <thead>
        <th>Field Name</th>
        <th>Motel Category Id</th>
        <th>Description</th>
        <th>Html Type</th>
        <th>Db Type</th>
        <th>Default Value</th>
        <th>Location</th>
        <th>Icon</th>
        <th>Image</th>
        <th>Class Css</th>
        <th>Order</th>
        <th>Slug</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($configMotelCategories as $configMotelCategory)
        <tr>
            <td>{!! $configMotelCategory->field_name !!}</td>
            <td>{!! $configMotelCategory->motel_category_id !!}</td>
            <td>{!! $configMotelCategory->description !!}</td>
            <td>{!! $configMotelCategory->html_type !!}</td>
            <td>{!! $configMotelCategory->db_type !!}</td>
            <td>{!! $configMotelCategory->default_value !!}</td>
            <td>{!! $configMotelCategory->location !!}</td>
            <td>{!! $configMotelCategory->icon !!}</td>
            <td>{!! $configMotelCategory->image !!}</td>
            <td>{!! $configMotelCategory->class_css !!}</td>
            <td>{!! $configMotelCategory->order !!}</td>
            <td>{!! $configMotelCategory->slug !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.configMotelCategories.destroy', $configMotelCategory->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.configMotelCategories.show', [$configMotelCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.configMotelCategories.edit', [$configMotelCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".Lang::get('messages.are_you_sure')."')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<table class="table table-striped table-bordered table-hover">
    <tbody>
    <tr>
        <td width="150">{!! Form::label('id', 'Id:') !!}</td>
        <td>{!! $group->id !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('name', 'Name:') !!}</td>
        <td>{!! $group->name !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('description', 'Description:') !!}</td>
        <td>{!! $group->description !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('created_at', 'Created At:') !!}</td>
        <td>{!! $group->created_at !!}</td>
    </tr><tr>
        <td>{!! Form::label('updated_at', 'Updated At:') !!}</td>
        <td>{!! $group->updated_at !!}</td>
    </tr>
    </tbody>
</table>

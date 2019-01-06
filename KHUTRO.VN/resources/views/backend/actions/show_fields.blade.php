<table class="table table-striped table-bordered table-hover">
    <tbody>
    <tr>
        <td width="150">{!! Form::label('id', 'Id') !!}</td>
        <td>{!! $action->id !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('name', 'Name') !!}</td>
        <td>{!! $action->name !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('slug', 'Slug') !!}</td>
        <td>{!! $action->slug !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('description', 'Description') !!}</td>
        <td>{!! $action->description !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('create_at', 'Create_at') !!}</td>
        <td>{!! $action->created_at !!}</td>
    </tr><tr>
        <td>{!! Form::label('update_at', 'Update_at') !!}</td>
        <td>{!! $action->updated_at !!}</td>
    </tr>
    </tbody>
</table>




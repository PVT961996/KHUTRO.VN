<table class="table table-striped table-bordered table-hover">
    <tbody>
    <tr>
        <td width="150">{!! Form::label('id', 'Id') !!}</td>
        <td>{!! $table->id !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('name', 'Name') !!}</td>
        <td>{!! $table->name !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('slug', 'Slug') !!}</td>
        <td>{!! $table->slug !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('create_at', 'Create_at') !!}</td>
        <td>{!! $table->created_at !!}</td>
    </tr><tr>
        <td>{!! Form::label('update_at', 'Update_at') !!}</td>
        <td>{!! $table->updated_at !!}</td>
    </tr>
    </tbody>
</table>


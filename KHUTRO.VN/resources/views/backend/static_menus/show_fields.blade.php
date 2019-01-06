<table class="table table-striped table-bordered table-hover">
    <tbody>
    <tr>
        <td width="150">{!! Form::label('id', 'Id:') !!}</td>
        <td>{!! $staticMenu->id !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('title', 'Title') !!}</td>
        <td>{!! $staticMenu->title !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('link', 'Link') !!}</td>
        <td>{!! $staticMenu->link !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('parent', 'Parent') !!}</td>
        <td>{!! $staticMenu->parent()->first()->title !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('create_at', 'Create_at') !!}</td>
        <td>{!! $staticMenu->created_at !!}</td>
    </tr><tr>
        <td>{!! Form::label('update_at', 'Update_at') !!}</td>
        <td>{!! $staticMenu->updated_at !!}</td>
    </tr>
    </tbody>
</table>








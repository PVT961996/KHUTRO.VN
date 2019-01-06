<table class="table table-striped table-bordered table-hover">
    <tbody>
    <tr>
        <td width="150">{!! Form::label('id', Lang::get('messages.id')) !!}</td>
        <td>{!! $province->id !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('name', Lang::get('messages.name_province')) !!}</td>
        <td>{!! $province->name !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('description', Lang::get('messages.description')) !!}</td>
        <td>{!! $province->description !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('slug', Lang::get('messages.slug')) !!}</td>
        <td>{!! $province->slug !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('created_at', Lang::get('messages.created_at')) !!}</td>
        <td>{!! $province->created_at !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('updated_at', Lang::get('messages.updated_at')) !!}</td>
        <td>{!! $province->updated_at !!}</td>
    </tr>
    </tbody>
</table>

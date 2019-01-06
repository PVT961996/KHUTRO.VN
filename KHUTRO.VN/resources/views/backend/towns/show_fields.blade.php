<table class="table table-striped table-bordered table-hover">
    <tbody>
    <tr>
        <td width="150">{!! Form::label('id', Lang::get('messages.id')) !!}</td>
        <td>{!! $town->id !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('name', Lang::get('messages.name')) !!}</td>
        <td>{!! $town->name !!}</td>
    </tr>
    <tr>
        {!! Form::label('district_id', Lang::get('messages.district_id')) !!}
        <p>{!! $town->district_id !!}</p>
    </tr>
    <tr>
        <td>{!! Form::label('description', Lang::get('messages.description')) !!}</td>
        <td>{!! $town->description !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('slug', Lang::get('messages.slug')) !!}</td>
        <td>{!! $town->slug !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('created_at', Lang::get('messages.created_at')) !!}</td>
        <td>{!! $town->created_at !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('updated_at', Lang::get('messages.updated_at')) !!}</td>
        <td>{!! $town->updated_at !!}</td>
    </tr>
    </tbody>
</table>


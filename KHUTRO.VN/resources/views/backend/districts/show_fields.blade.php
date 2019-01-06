<table class="table table-striped table-bordered table-hover">
    <tbody>
    <tr>
        <td width="150">{!! Form::label('id', Lang::get('messages.id')) !!}</td>
        <td>{!! $district->id !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('name', Lang::get('messages.name')) !!}</td>
        <td>{!! $district->name !!}</td>
    </tr>
    <tr>
        {!! Form::label('province_id', Lang::get('messages.province_id')) !!}
        <p>{!! $district->province_id !!}</p>
    </tr>
    <tr>
        <td>{!! Form::label('description', Lang::get('messages.description')) !!}</td>
        <td>{!! $district->description !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('slug', Lang::get('messages.slug')) !!}</td>
        <td>{!! $district->slug !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('created_at', Lang::get('messages.created_at')) !!}</td>
        <td>{!! $district->created_at !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('updated_at', Lang::get('messages.updated_at')) !!}</td>
        <td>{!! $district->updated_at !!}</td>
    </tr>
    </tbody>
</table>

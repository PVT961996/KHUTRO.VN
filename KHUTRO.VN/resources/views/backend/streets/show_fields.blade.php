<table class="table table-striped table-bordered table-hover">
    <tbody>
    <tr>
        <td width="150">{!! Form::label('id', Lang::get('messages.id')) !!}</td>
        <td>{!! $street->id !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('name', Lang::get('messages.name')) !!}</td>
        <td>{!! $street->name !!}</td>
    </tr>
    <tr>
        {!! Form::label('town_id', Lang::get('messages.town_id')) !!}
        <p>{!! $street->town_id !!}</p>
    </tr>
    <tr>
        <td>{!! Form::label('description', Lang::get('messages.description')) !!}</td>
        <td>{!! $street->description !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('slug', Lang::get('messages.slug')) !!}</td>
        <td>{!! $street->slug !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('created_at', Lang::get('messages.created_at')) !!}</td>
        <td>{!! $street->created_at !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('updated_at', Lang::get('messages.updated_at')) !!}</td>
        <td>{!! $street->updated_at !!}</td>
    </tr>
    </tbody>
</table>

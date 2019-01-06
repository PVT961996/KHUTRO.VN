<table class="table table-striped table-bordered table-hover">
    <tbody>
    <tr>
        <td>{!! Form::label('name', Lang::get('messages.name')) !!}</td>
        <td>{!! $configPrice->name !!}</td>
    </tr>

    <tr>
        <td>{!! Form::label('description', Lang::get('messages.description')) !!}</td>
        <td>{!! $configPrice->description !!}</td>
    </tr>

    <tr>
        <td>{!! Form::label('number_views', Lang::get('messages.number_views')) !!}</td>
        <td>{!! $configPrice->number_views !!}</td>
    </tr>


    <tr>
        <td>{!! Form::label('create_at', Lang::get('messages.create_at')) !!}</td>
        <td>{!! $configPrice->created_at !!}</td>
    </tr>
    </tbody>
</table>



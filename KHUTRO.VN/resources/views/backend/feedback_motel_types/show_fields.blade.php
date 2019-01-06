<table class="table table-striped table-bordered table-hover">
    <tbody>
    <tr>
        <td>{!! Form::label('name', Lang::get('messages.name')) !!}</td>
        <td>{!! $feedbackMotelType->name !!}</td>
    </tr>

    <tr>
        <td>{!! Form::label('description', Lang::get('messages.description')) !!}</td>
        <td>{!! $feedbackMotelType->description !!}</td>
    </tr>

    <tr>
        <td>{!! Form::label('create_at', Lang::get('messages.create_at')) !!}</td>
        <td>{!! $feedbackMotelType->created_at !!}</td>
    </tr>

    </tbody>
</table>


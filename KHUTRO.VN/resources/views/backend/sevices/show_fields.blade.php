<table class="table table-striped table-bordered table-hover">
    <tbody>
    <tr>
        <td>{!! Form::label('name', Lang::get('messages.name')) !!}</td>
        <td>{!! $sevice->name !!}</td>
    </tr>

    <tr>
        <td>{!! Form::label('description', Lang::get('messages.description')) !!}</td>
        <td>{!! $sevice->description !!}</td>
    </tr>

    <tr>
        <td>{!! Form::label('order', Lang::get('messages.sevice_order')) !!}</td>
        <td>{!! $sevice->order !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('icon', Lang::get('messages.icon')) !!}</td>
        <td>{!! $sevice->icon !!}</td>
    </tr>

    <tr>
        <td>{!! Form::label('class_css', Lang::get('messages.sevice_class_css')) !!}</td>
        <td>{!! $sevice->class_css !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('price', Lang::get('messages.price')) !!}</td>
        <td>{!! $sevice->price !!}</td>
    </tr>
    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('image', Lang::get('messages.image')) !!}</th>
        <td><p><img src="{!! $sevice->image !!}" height="200px"></p></td>
    </tr>
    <tr>
        <td>{!! Form::label('create_at', Lang::get('messages.create_at')) !!}</td>
        <td>{!! $sevice->created_at !!}</td>
    </tr>
    </tbody>
</table>




<table class="table table-striped table-bordered table-hover">
    <tbody>
    <tr>
        <td>{!! Form::label('name', Lang::get('messages.name')) !!}</td>
        <td>{!! $device->name !!}</td>
    </tr>

    <tr>
        <td>{!! Form::label('description', Lang::get('messages.description')) !!}</td>
        <td>{!! $device->description !!}</td>
    </tr>

    <tr>
        <td>{!! Form::label('order', Lang::get('messages.device_order')) !!}</td>
        <td>{!! $device->order !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('icon', Lang::get('messages.device_icon')) !!}</td>
        <td>{!! $device->icon !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('class_css', Lang::get('messages.device_class_css')) !!}</td>
        <td>{!! $device->class_css !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('create_at', Lang::get('messages.create_at')) !!}</td>
        <td>{!! $device->created_at !!}</td>
    </tr>
    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('image', Lang::get('messages.image')) !!}</th>
        <td><p><img src="{!! $device->image !!}" height="200px"></p></td>
    </tr>

    </tbody>
</table>


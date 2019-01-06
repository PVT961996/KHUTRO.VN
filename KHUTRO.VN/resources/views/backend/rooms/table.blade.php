<table class="table table-responsive" id="rooms-table">
    <thead>
        <th>Name</th>
        <th>Motel Id</th>
        <th>Area</th>
        <th>Number People</th>
        <th>Price</th>
        <th>Status</th>
        <th>Toilet</th>
        <th>Description</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($rooms as $room)
        <tr>
            <td>{!! $room->name !!}</td>
            <td>{!! $room->motel_id !!}</td>
            <td>{!! $room->area !!}</td>
            <td>{!! $room->number_people !!}</td>
            <td>{!! $room->price !!}</td>
            <td>{!! $room->status !!}</td>
            <td>{!! $room->toilet !!}</td>
            <td>{!! $room->description !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.rooms.destroy', $room->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.rooms.show', [$room->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.rooms.edit', [$room->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
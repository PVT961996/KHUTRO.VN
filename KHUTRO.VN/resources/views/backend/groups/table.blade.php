<table class="table table-striped table-bordered table-hover" id="groups-table">
    <thead>
    <th class="center" width="30px">#</th>
    <th class="center" width="40px">
        <input type="checkbox" name="check-all" id="check-all" class="icheck check-all"/>
    </th>
    <th class="center">Name</th>
    <th class="center">Description</th>
    <th class="center" width="210px">Action</th>
    </thead>
    <tbody>
    @foreach($groups as $index => $group)
        <tr>
            <td class="center"><a href="{!! route('admin.groups.show', [$group->id]) !!}" >{!! $index+1 !!}.</a></td>
            <td class="center"><input type="checkbox" name="ids[]" value="{{ $group->id }}" class="icheck check-single" form="items" /></td>
            <td>{!! $group->name !!}</td>
            <td>{!! $group->description !!}</td>
            <td class="center">
                {!! Form::open(['route' => ['admin.groups.destroy', $group->id], 'method' => 'delete']) !!}
                <div class="clearfix">
                    @if($group->active == '0')
                        <input type="checkbox" class="make-switch active_checkbox" value="{{$group->id}}" data-on-text="<i class='fa fa-check'><i>" data-off-text="<i class='fa fa-ban'><i>" data-size="small" data-on-color="success" data-off-color="warning">
                    @else
                        <input type="checkbox" checked class="make-switch active_checkbox" value="{{$group->id}}" data-on-text="<i class='fa fa-check'><i>" data-off-text="<i class='fa fa-ban'><i>" data-size="small" data-on-color="success" data-off-color="warning">
                    @endif
                    <a href="{!! route('admin.groups.show', [$group->id]) !!}"class='btn btn btn-xs grey-cascade'><i class="fa fa-eye"></i></a>
                    <a href="{!! route('admin.groups.edit', [$group->id]) !!}" class='btn btn btn-xs blue'><i class="fa fa-edit"></i></a>
                    <a href="{!! route('admin.groups.duplicate', [$group->id]) !!}" class='btn btn btn-xs green-jungle'><i class="fa fa-copy"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn btn-xs red', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
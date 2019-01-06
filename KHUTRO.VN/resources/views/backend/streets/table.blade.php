<table class="table table-striped table-bordered table-hover" id="streets-table">
    <thead>
    <th width="10px">#</th>
    <th width="30px">
        <input type="checkbox" name="check-all" id="check-all" class="icheck check-all"/>
    </th>
    <th>@lang("messages.name_street")</th>
    <th>@lang("messages.town_id")</th>
    <th>@lang("messages.description")</th>
    <th>@lang("messages.slug")</th>
    <th width="210px">@lang("messages.action")</th>
    </thead>
    <tbody>
    @foreach($streets as $index =>  $street)
        <tr>
            <td class="center"><a href="{!! route('admin.streets.show', [$street->id]) !!}" >{!! $index+1 !!}.</a></td>
            <td class="center"><input type="checkbox" name="ids[]" value="{{ $street->id }}" class="icheck check-single" form="items" /></td>
            <td>{!! $street->name !!}</td>
            <td>{!! $street->town->name !!}</td>
            <td>{!! $street->description !!}</td>
            <td>{!! $street->slug !!}</td>
            <td class="center">
                {!! Form::open(['route' => ['admin.streets.destroy', $street->id], 'method' => 'delete']) !!}
                <div class="clearfix">
                    @if($street->active == '0')
                        <input type="checkbox" class="make-switch active_checkbox" value="{{$street->id}}" data-on-text="<i class='fa fa-check'><i>" data-off-text="<i class='fa fa-ban'><i>" data-size="small" data-on-color="success" data-off-color="warning">
                    @else
                        <input type="checkbox" checked class="make-switch active_checkbox" value="{{$street->id}}" data-on-text="<i class='fa fa-check'><i>" data-off-text="<i class='fa fa-ban'><i>" data-size="small" data-on-color="success" data-off-color="warning">
                    @endif
                    <a href="{!! route('admin.streets.show', [$street->id]) !!}"class='btn btn btn-xs grey-cascade'><i class="fa fa-eye"></i></a>
                    <a href="{!! route('admin.streets.edit', [$street->id]) !!}" class='btn btn btn-xs blue'><i class="fa fa-edit"></i></a>
                    <a href="{!! route('admin.streets.duplicate', [$street->id]) !!}" class='btn btn btn-xs green-jungle'><i class="fa fa-copy"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn btn-xs red', 'onclick' => "return confirm('".Lang::get('messages.are_you_sure')."')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
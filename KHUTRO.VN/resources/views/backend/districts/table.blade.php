<table class="table table-striped table-bordered table-hover" id="districts-table">
    <thead>
    <th width="10px">#</th>
    <th width="30px">
        <input type="checkbox" name="check-all" id="check-all" class="icheck check-all"/>
    </th>
    <th>@lang("messages.name_district")</th>
    <th>@lang("messages.province_id")</th>
    <th>@lang("messages.description")</th>
    <th>@lang("messages.slug")</th>
    <th width="210px">@lang("messages.action")</th>
    </thead>
    <tbody>
    @foreach($districts as $index =>  $district)
        <tr>
            <td class="center"><a href="{!! route('admin.districts.show', [$district->id]) !!}" >{!! $index+1 !!}.</a></td>
            <td class="center"><input type="checkbox" name="ids[]" value="{{ $district->id }}" class="icheck check-single" form="items" /></td>
            <td>{!! $district->name !!}</td>
            <td>{!! $district->province->name !!}</td>
            <td>{!! $district->description !!}</td>
            <td>{!! $district->slug !!}</td>
            <td class="center">
                {!! Form::open(['route' => ['admin.districts.destroy', $district->id], 'method' => 'delete']) !!}
                <div class="clearfix">
                    @if($district->active == '0')
                        <input type="checkbox" class="make-switch active_checkbox" value="{{$district->id}}" data-on-text="<i class='fa fa-check'><i>" data-off-text="<i class='fa fa-ban'><i>" data-size="small" data-on-color="success" data-off-color="warning">
                    @else
                        <input type="checkbox" checked class="make-switch active_checkbox" value="{{$district->id}}" data-on-text="<i class='fa fa-check'><i>" data-off-text="<i class='fa fa-ban'><i>" data-size="small" data-on-color="success" data-off-color="warning">
                    @endif
                    <a href="{!! route('admin.districts.show', [$district->id]) !!}"class='btn btn btn-xs grey-cascade'><i class="fa fa-eye"></i></a>
                    <a href="{!! route('admin.districts.edit', [$district->id]) !!}" class='btn btn btn-xs blue'><i class="fa fa-edit"></i></a>
                    <a href="{!! route('admin.districts.duplicate', [$district->id]) !!}" class='btn btn btn-xs green-jungle'><i class="fa fa-copy"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn btn-xs red', 'onclick' => "return confirm('".Lang::get('messages.are_you_sure')."')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
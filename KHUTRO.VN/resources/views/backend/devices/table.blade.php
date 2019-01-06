<table class="table table-striped table-bordered table-hover" id="devices-table">
    <thead>
    <th class="center">#</th>
    <th class="center">
        <input type="checkbox" name="check-all" id="check-all" class="icheck check-all"/>
    </th>
    <th>@lang('messages.name')</th>
    <th>@lang('messages.description')</th>
    <th>@lang('messages.device_order')</th>
    <th>@lang('messages.device_icon')</th>
    <th>@lang('messages.image')</th>
    <th>@lang('messages.device_class_css')</th>
    <th colspan="3">@lang('messages.action')</th>
    </thead>
    <tbody>
    @if (count($devices) == 0)
        <tr class="text-center">
            <td colspan="12">@lang('messages.no-items')</td>
        </tr>
    @else
        @foreach($devices as $index => $device)
            <tr>
                <td class="center"><a href="{!! route('admin.devices.show', [$device->id]) !!}" >{!! $index+1 !!}.</a></td>
                <td class="center"><input type="checkbox" name="ids[]" value="{{ $device->id }}" class="icheck check-single" form="items" /></td>
                <td>{!! $device->name !!}</td>
                <td>{!! $device->description !!}</td>
                <td>{!! $device->order !!}</td>
                <td>{!! $device->icon !!}</td>
                @if(empty($device->image))
                    <td></td>
                @else
                    <td><img src="{!! $device->image !!}" height="50px"></td>
                @endif
                <td>{!! $device->class_css !!}</td>

                <td class="center">
                    {!! Form::open(['route' => ['admin.devices.destroy', $device->id], 'method' => 'delete']) !!}
                    <div class="clearfix">
                        <a href="{!! route('admin.devices.show', [$device->id]) !!}" class="btn btn btn-xs grey-cascade">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{!! route('admin.devices.edit', [$device->id]) !!}" class="btn btn btn-xs blue">
                            <i class="fa fa-edit"></i>
                        </a>
                        {{--<a href="{!! route('admin.devices.duplicate', [$device->id]) !!}" class="btn btn btn-xs green-jungle">--}}
                        {{--<i class="fa fa-copy"></i>--}}
                        {{--</a>--}}
                        {{--<a href="#" class="btn btn btn-xs green">--}}
                        {{--<i class="fa fa-check"></i>--}}
                        {{--</a>--}}
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn btn-xs red', 'onclick' => "return confirm('".Lang::get('messages.are_you_sure')."')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
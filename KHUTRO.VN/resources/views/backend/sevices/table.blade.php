<table class="table table-striped table-bordered table-hover" id="sevices-table">
    <thead>
    <th class="center">#</th>
    <th class="center">
        <input type="checkbox" name="check-all" class="icheck check-all"/>
    </th>
    <th>@lang('messages.name')</th>
    <th>@lang('messages.description')</th>
    <th>@lang('messages.sevice_order')</th>
    <th>@lang('messages.icon')</th>
    <th>@lang('messages.image')</th>
    <th>@lang('messages.class_css')</th>
    <th>@lang('messages.price')</th>
    <th colspan="3">@lang('messages.action')</th>
    </thead>
    <tbody>
    @if (count($sevices) == 0)
        <tr class="text-center">
            <td colspan="12">@lang('messages.no-items')</td>
        </tr>
    @else
        @foreach($sevices as $index => $sevice)
            <tr>
                <td class="center"><a href="{!! route('admin.sevices.show', [$sevice->id]) !!}" >{!! $index+1 !!}.</a></td>
                <td class="center"><input type="checkbox" name="ids[]" value="{{ $sevice->id }}" class="icheck check-single" form="items" /></td>
                <td>{!! $sevice->name !!}</td>
                <td>{!! $sevice->description !!}</td>
                <td>{!! $sevice->order !!}</td>

                <td>{!! $sevice->icon !!}</td>
                @if(empty($sevice->image))
                    <td></td>
                @else
                    <td><img src="{!! $sevice->image !!}" height="30px"></td>
                @endif
                <td>{!! $sevice->class_css !!}</td>
                <td>{!! $sevice->price !!}</td>

                <td class="center">
                    {!! Form::open(['route' => ['admin.sevices.destroy', $sevice->id], 'method' => 'delete']) !!}
                    <div class="clearfix">
                        <a href="{!! route('admin.sevices.show', [$sevice->id]) !!}" class="btn btn btn-xs grey-cascade">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{!! route('admin.sevices.edit', [$sevice->id]) !!}" class="btn btn btn-xs blue">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{!! route('admin.sevices.duplicate', [$sevice->id]) !!}" class="btn btn btn-xs green-jungle">
                            <i class="fa fa-copy"></i>
                        </a>
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
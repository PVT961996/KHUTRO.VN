<table class="table table-striped table-bordered table-hover" id="configPrice-table">
    <thead>
    <th class="center">#</th>
    <th class="center">
        <input type="checkbox" name="check-all" class="icheck check-all"/>
    </th>
    <th>@lang('messages.name')</th>
    <th>@lang('messages.description')</th>
    <th>@lang('messages.number_views')</th>
    <th colspan="3">@lang('messages.action')</th>
    </thead>
    <tbody>
    @if (count($configPrices) == 0)
        <tr class="text-center">
            <td colspan="12">@lang('messages.no-items')</td>
        </tr>
    @else
        @foreach($configPrices as $index => $configPrice)
            <tr>
                <td class="center"><a href="{!! route('admin.configPrices.show', [$configPrice->id]) !!}" >{!! $index+1 !!}.</a></td>
                <td class="center"><input type="checkbox" name="ids[]" value="{{ $configPrice->id }}" class="icheck check-single" form="items" /></td>
                <td>{!! $configPrice->name !!}</td>
                <td>{!! $configPrice->description !!}</td>
                <td>{!! $configPrice->number_views !!}</td>


                <td class="center">
                    {!! Form::open(['route' => ['admin.configPrices.destroy', $configPrice->id], 'method' => 'delete']) !!}
                    <div class="clearfix">
                        <a href="{!! route('admin.configPrices.show', [$configPrice->id]) !!}" class="btn btn btn-xs grey-cascade">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{!! route('admin.configPrices.edit', [$configPrice->id]) !!}" class="btn btn btn-xs blue">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{!! route('admin.configPrices.duplicate', [$configPrice->id]) !!}" class="btn btn btn-xs green-jungle">
                            <i class="fa fa-copy"></i>
                        </a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn btn-xs red', 'onclick' => "return confirm('".Lang::get('messages.are_you_sure')."')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
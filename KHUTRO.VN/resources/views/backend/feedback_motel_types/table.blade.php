<table class="table table-striped table-bordered table-hover" id="feedbackMotelType-table">
    <thead>
    <th class="center">#</th>
    <th class="center">
        <input type="checkbox" name="check-all" id="check-all" class="icheck check-all"/>
    </th>
    <th>@lang('messages.name')</th>
    <th>@lang('messages.description')</th>
    <th colspan="3">@lang('messages.action')</th>
    </thead>
    <tbody>
    @if (count($feedbackMotelTypes) == 0)
        <tr class="text-center">
            <td colspan="12">@lang('messages.no-items')</td>
        </tr>
    @else
        @foreach($feedbackMotelTypes as $index => $feedbackMotelType)
            <tr>
                <td class="center"><a href="{!! route('admin.feedbackMotelTypes.show', [$feedbackMotelType->id]) !!}" >{!! $index+1 !!}.</a></td>
                <td class="center"><input type="checkbox" name="ids[]" value="{{ $feedbackMotelType->id }}" class="icheck check-single" form="items" /></td>
                <td>{!! $feedbackMotelType->name !!}</td>
                <td>{!! $feedbackMotelType->description !!}</td>
                <td class="center">
                    {!! Form::open(['route' => ['admin.feedbackMotelTypes.destroy', $feedbackMotelType->id], 'method' => 'delete']) !!}
                    <div class="clearfix">
                        <a href="{!! route('admin.feedbackMotelTypes.show', [$feedbackMotelType->id]) !!}" class="btn btn btn-xs grey-cascade">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{!! route('admin.feedbackMotelTypes.edit', [$feedbackMotelType->id]) !!}" class="btn btn btn-xs blue">
                            <i class="fa fa-edit"></i>
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
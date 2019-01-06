<table class="table table-striped table-bordered table-hover" id="postCategories-table">
    <thead>
    <th class="center" width="50px ">#</th>
    <th class="center" width="50px">
        <input type="checkbox" name="check-all" id="check-all" class="icheck check-all"/>
    </th>
    <th class="center">@lang('messages.name')</th>
    <th class="center">@lang('messages.description')</th>
    {{--<th class="center">Parent Id</th>--}}
    <th class="center" width="180px">@lang('messages.action')</th>
    </thead>
    <tbody>

    @if (count($postCategories) == 0)
        <tr class="text-center">
            <td colspan="6">@lang('messages.no-items')</td>
        </tr>
    @else
        @foreach($postCategories as $index => $postCategory)
            <tr>
                <td class="center"><a href="{!! route('admin.postCategories.show', [$postCategory->id]) !!}" >{!! $index+1 !!}.</a></td>
                <td class="center"><input type="checkbox" name="ids[]" value="{{ $postCategory->id }}" class="icheck check-single" form="items" /></td>
                <td>{!! $postCategory->name !!}</td>
                <td>{!! $postCategory->description !!}</td>
                {{--<td>{!! $category->parent_id !!}</td>--}}
                <td class="center">
                    {!! Form::open(['route' => ['admin.postCategories.destroy', $postCategory->id], 'method' => 'delete']) !!}
                    <div class="clearfix">
                        <a href="{!! route('admin.postCategories.show', [$postCategory->id]) !!}" class="btn btn btn-xs grey-cascade">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{!! route('admin.postCategories.edit', [$postCategory->id]) !!}" class="btn btn btn-xs blue">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{!! route('admin.postCategories.duplicate', [$postCategory->id]) !!}" class="btn btn btn-xs green-jungle">
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
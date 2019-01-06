<table class="table table-striped table-bordered table-hover" id="actions-table">
    <thead>
    <th class="center">#</th>
    <th class="center">
        <input type="checkbox" name="check-all" id="check-all" class="icheck check-all"/>
    </th>
    <th>Name</th>
    <th>Description</th>
    <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($tags as $index => $tag)
        <tr>
            <td class="center"><a href="{!! route('admin.tags.show', [$tag->id]) !!}" >{!! $index+1 !!}.</a></td>
            <td class="center"><input type="checkbox" name="ids[]" value="{{ $tag->id }}" class="icheck check-single" form="items" /></td>
            <td>{!! $tag->name !!}</td>
            <td>{!! $tag->description !!}</td>
            <td class="center">
                {!! Form::open(['route' => ['admin.tags.destroy', $tag->id], 'method' => 'delete']) !!}
                <div class="clearfix">
                    <a href="{!! route('admin.tags.show', [$tag->id]) !!}" class="btn btn btn-xs grey-cascade">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{!! route('admin.tags.edit', [$tag->id]) !!}" class="btn btn btn-xs blue">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{!! route('admin.tags.duplicate', [$tag->id]) !!}" class="btn btn btn-xs green-jungle">
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
    </tbody>
</table>
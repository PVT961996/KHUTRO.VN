<table class="table table-striped table-bordered table-hover" id="staticMenus-table">
    <thead>
    <th class="center">#</th>
    <th class="center">
        <input type="checkbox" name="check-all" id="check-all" class="icheck check-all"/>
    </th>
    <th>Title</th>
    <th>Link</th>
    <th>Parent</th>
    <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($staticMenus as $index => $staticMenu)
        <tr>
            <td class="center"><a href="{!! route('admin.staticMenus.show', [$staticMenu->id]) !!}" >{!! $index+1 !!}.</a></td>
            <td class="center"><input type="checkbox" name="ids[]" value="{{ $staticMenu->id }}" class="icheck check-single" form="items" /></td>
            <td>{!! $staticMenu->title !!}</td>
            <td>{!! $staticMenu->link !!}</td>
            @if ($staticMenu->parent_id != $staticMenu->id)
                <td><a href="{!! route('admin.staticMenus.show', [$staticMenu->parent()->first()->id]) !!}">{!! $staticMenu->parent()->first()->title !!}</a></td>
            @else
                <td></td>
            @endif
            <td class="center">
                {!! Form::open(['route' => ['admin.staticMenus.destroy', $staticMenu->id], 'method' => 'delete']) !!}
                <div class="clearfix">
                    <a href="{!! route('admin.staticMenus.show', [$staticMenu->id]) !!}" class="btn btn btn-xs grey-cascade">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{!! route('admin.staticMenus.edit', [$staticMenu->id]) !!}" class="btn btn btn-xs blue">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{!! route('admin.staticMenus.duplicate', [$staticMenu->id]) !!}" class="btn btn btn-xs green-jungle">
                        <i class="fa fa-copy"></i>
                    </a>
                    <a disabled="true" href="#" class="btn btn btn-xs green">
                        <i class="fa fa-check"></i>
                    </a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn btn-xs red', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
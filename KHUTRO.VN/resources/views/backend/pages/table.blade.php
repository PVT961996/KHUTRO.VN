<table class="table table-striped table-bordered table-hover" id="pages-table">
    <thead>
        <th class="center">#</th>
        <th class="center">
            <input type="checkbox" name="check-all" id="check-all" class="icheck check-all"/>
        </th>
        <th>Title</th>
        <th>Author</th>
        <th>Parent</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
        @foreach($pages as $index => $page)
            <tr>
                <td class="center"><a href="{!! route('admin.pages.show', [$page->id]) !!}" >{!! $index+1 !!}.</a></td>
                <td class="center"><input type="checkbox" name="ids[]" value="{{ $page->id }}" class="icheck check-single" form="items" /></td>
                <td>{!! $page->title !!}</td>
                <td><a href="{!! route('admin.users.show', $page->user()->first()->id) !!}">{!! $page->user()->first()->name !!}</a></td>
                @if ($page->parent_id != $page->id)
                    <td class="center"><a href="{!! route('admin.pages.show', [$page->parent()->first()->id]) !!}" >{!! $page->parent()->first()->title !!}</a></td>
                @else
                    <td></td>
                @endif
                <td class="center">
                    {!! Form::open(['route' => ['admin.pages.destroy', $page->id], 'method' => 'delete']) !!}
                    <div class="clearfix">
                        <a href="{!! route('admin.pages.show', [$page->id]) !!}" class="btn btn btn-xs grey-cascade">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{!! route('admin.pages.edit', [$page->id]) !!}" class="btn btn btn-xs blue">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{!! route('admin.pages.duplicate', [$page->id]) !!}" class="btn btn btn-xs green-jungle">
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
<table class="table table-striped table-bordered table-hover" id="tables-table">
    <thead>
    <th class="center">#</th>
    <th class="center">
        <input type="checkbox" name="check-all" id="check-all" class="icheck check-all"/>
    </th>
    <th>Name</th>
    <th class="center">Action</th>
    </thead>
    <tbody>
    @foreach($tables as $index => $table)
        <tr>
            <td class="center"><a href="{!! route('admin.tables.show', [$table->id]) !!}" >{!! $index+1 !!}.</a></td>
            <td class="center"><input type="checkbox" name="ids[]" value="{{ $table->id }}" class="icheck check-single" form="items" /></td>
            <td>{!! $table->name !!}</td>
            <td class="center">
                {!! Form::open(['route' => ['admin.tables.destroy', $table->id], 'method' => 'delete']) !!}
                <div class="clearfix">
                    <a href="{!! route('admin.tables.show', [$table->id]) !!}" class="btn btn btn-xs grey-cascade">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{!! route('admin.tables.edit', [$table->id]) !!}" class="btn btn btn-xs blue">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{!! route('admin.tables.duplicate', [$table->id]) !!}" class="btn btn btn-xs green-jungle">
                        <i class="fa fa-copy"></i>
                    </a>
                    <a href="#" class="btn btn btn-xs green">
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
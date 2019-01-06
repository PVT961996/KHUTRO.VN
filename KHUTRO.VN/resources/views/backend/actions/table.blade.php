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
    @foreach($actions as $index => $action)
        <tr>
            <td class="center"><a href="{!! route('admin.actions.show', [$action->id]) !!}" >{!! $index+1 !!}.</a></td>
            <td class="center"><input type="checkbox" name="ids[]" value="{{ $action->id }}" class="icheck check-single" form="items" /></td>
            {{--<input type="hidden" name="ids[]" value="{{ $action->id }}" class="icheck check-single" form="form_active" />--}}
            <td>{!! $action->name !!}</td>
            <td>{!! $action->description !!}</td>
            <td class="center">
                {!! Form::open(['route' => ['admin.actions.destroy', $action->id], 'method' => 'delete']) !!}
                <div class="clearfix">
                        @if($action->active == '0')
                            <input type="checkbox" class="make-switch active_checkbox" value="{{$action->id}}" data-on-text="<i class='fa fa-check'><i>" data-off-text="<i class='fa fa-ban'><i>" data-size="small" data-on-color="success" data-off-color="warning">
                        @else
                            <input type="checkbox" checked class="make-switch active_checkbox" value="{{$action->id}}" data-on-text="<i class='fa fa-check'><i>" data-off-text="<i class='fa fa-ban'><i>" data-size="small" data-on-color="success" data-off-color="warning">
                        @endif
                    <a href="{!! route('admin.actions.show', [$action->id]) !!}" class="btn btn btn-xs grey-cascade">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{!! route('admin.actions.edit', [$action->id]) !!}" class="btn btn btn-xs blue">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{!! route('admin.actions.duplicate', [$action->id]) !!}" class="btn btn btn-xs green-jungle">
                        <i class="fa fa-copy"></i>
                    </a>
                    <a href="#" class="btn btn btn-xs green">
                        <i class="fa fa-check"></i>
                    </a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn btn-xs red', 'onclick' => "return confirm('".Lang::get('messages.are_you_sure')."')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
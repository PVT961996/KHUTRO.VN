<table class="table table-striped table-bordered table-hover">
    <tbody>
    <tr>
        <td>{!! Form::label('name', __("messages.name")) !!}</td>
        <td>{!! $motelCategory->name !!}</td>
    </tr>
    <tr>

        <td>{!! Form::label('parent_id', __("messages.parent")) !!}</td>
        @if(!empty($motelCategory->parent))
            <td>{!! $motelCategory->parent['name'] !!}</td>
        @else
            <td> @lang("messages.original_category") </td>
        @endif
    </tr>
    <tr>
        <td>{!! Form::label('description', __("messages.description")) !!}</td>
        <td>{!! $motelCategory->description !!}</td>
    </tr>

    <tr>
        <td>{!! Form::label('created_at', __("messages.create_at")) !!}</td>
        <td>{!! $motelCategory->created_at !!}</td>
    </tr>
    </tbody>
</table>





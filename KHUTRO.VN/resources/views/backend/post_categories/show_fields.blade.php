<table class="table table-striped table-bordered table-hover">
    <tbody>
    <tr>
        <td>{!! Form::label('name', __("messages.name")) !!}</td>
        <td>{!! $postCategory->name !!}</td>
    </tr>
    <tr>

        <td>{!! Form::label('parent_id', __("messages.parent")) !!}</td>
        @if(!empty($postCategory->parent))
            <td>{!! $postCategory->parent['name'] !!}</td>
        @else
            <td> @lang("messages.original_category") </td>
        @endif
    </tr>
    <tr>
        <td>{!! Form::label('description', __("messages.description")) !!}</td>
        <td>{!! $postCategory->description !!}</td>
    </tr>

    <tr>
        <td>{!! Form::label('created_at', __("messages.create_at")) !!}</td>
        <td>{!! $postCategory->created_at !!}</td>
    </tr>
    </tbody>
</table>







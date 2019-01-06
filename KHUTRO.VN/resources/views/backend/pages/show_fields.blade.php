<table class="table table-striped table-bordered table-hover">
    <tbody>
        <tr>
            <td width="150">{!! Form::label('id', 'Id:') !!}</td>
            <td>{!! $page->id !!}</td>
        </tr>
        <tr>
            <td>{!! Form::label('title', 'Title') !!}</td>
            <td>{!! $page->title !!}</td>
        </tr>
        <tr>
            <td>{!! Form::label('content', 'Content') !!}</td>
            <td>{!! $page->content !!}</td>
        </tr>
        <tr>
            <td>{!! Form::label('parent', 'Parent') !!}</td>
            <td>{!! $page->parent()->first()->title !!}</td>
        </tr>
        <tr>
            <td>{!! Form::label('author', 'Author') !!}</td>
            <td>{!! $page->user()->first()->name !!}</td>
        </tr>
        <tr>
            <td>{!! Form::label('slug', 'Slug') !!}</td>
            <td>{!! $page->slug !!}</td>
        </tr>
        <tr>
            <td>{!! Form::label('create_at', 'Create_at') !!}</td>
            <td>{!! $page->created_at !!}</td>
        </tr><tr>
            <td>{!! Form::label('update_at', 'Update_at') !!}</td>
            <td>{!! $page->updated_at !!}</td>
        </tr>
    </tbody>
</table>






<table class="table table-striped table-bordered table-hover">
    <tbody>
    <tr>
        <td>{!! Form::label('name', 'Name') !!}</td>
        <td>{!! $tag->name !!}</td>
    </tr>

    <tr>
        <td>{!! Form::label('description', 'Description') !!}</td>
        <td>{!! $tag->description !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('posts', 'Posts') !!}</td>

        <td>{!! toStringOf($tag->posts,'title','show','admin.posts.show') !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('create_at', 'Create_at') !!}</td>
        <td>{!! $tag->created_at !!}</td>
    </tr>
    </tbody>
</table>






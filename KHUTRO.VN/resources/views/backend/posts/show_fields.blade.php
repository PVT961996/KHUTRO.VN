
<table class="table table-bordered">
    <tbody>
    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('name',Lang::get('messages.title')) !!}</th>
        <td><p>{!! $post->title  !!}</p><br>
            <span style="float: right; color: #0000C0">{{$post->created_at}} </span></td>
    </tr>
    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('image_title',Lang::get('messages.image_title')) !!}</th>
        <td>
            @if(isset($post))
                <img style="width: 200px; height: 150px" src="{!! $post->image_title !!}">
            @else
                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
            @endif
        </td>

    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('user','User') !!}</th>
        <td><a href="{!! route('admin.users.show', [$post->user_id]) !!}" >{!! $post->user->name !!}</a></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('categories','Categories') !!}</th>
        <td>{!!toStringOf($post->postCategories,'name','show','admin.postCategories.show')!!}</td>
    </tr>
    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('tags','Tags') !!}</th>
        <td>{!!toStringOf($post->tags,'name','show','admin.tags.show')!!}</td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('description','Description') !!}</th>
        <td><p>{!! $post->short_description !!}</p></td>
    </tr>
    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('content','Content') !!}</th>
        <td><p>{!! $post->content !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('status','Status') !!}</th>
        <td><p>{!! $post->status !!}</p></td>
    </tr>
    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('post_visits','Post_visits') !!}</th>
        <td><p>{!! $post->views !!}</p></td>
    </tr>
    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('rate','Rate') !!}</th>
        <td><p>{!! $post->rate !!}</p></td>
    </tr>
    </tbody>
</table>



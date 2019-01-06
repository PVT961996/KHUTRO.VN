<table class="table table-striped table-bordered table-hover" id="actions-table">
    <thead>
    <th class="center">#</th>
    <th class="center">
        <input type="checkbox" name="check-all" id="check-all" class="icheck check-all"/>
    </th>
    <th>@lang('messages.title')</th>
    <th>@lang('messages.auth')</th>
    <th>@lang('messages.short_description')</th>
    <th>@lang('messages.create_at')</th>

    <th colspan="3">@lang('messages.action')</th>
    </thead>
    <tbody>
    @if (count($posts) == 0)
        <tr class="text-center">
            <td colspan="14">Không có bản ghi.</td>
        </tr>
    @else
        @foreach($posts as $index => $post)
            <tr>
                <td class="center"><a href="{!! route('admin.posts.show', [$post->id]) !!}" >{!! $index+1 !!}.</a></td>
                <td class="center"><input type="checkbox" name="ids[]" value="{{ $post->id }}" class="icheck check-single" form="items" /></td>
                <td>{!! $post->title !!}</td>
                <td><a href={{route('admin.users.show',$post->user->id)}}>{!! $post->user->name !!}</a></td>
                <td>{!! $post->short_description !!}</td>
                <td>{!! $post->created_at !!}</td>

                <td>
                    {!! Form::open(['route' => ['admin.posts.destroy', $post->id], 'method' => 'delete']) !!}
                    <div class="clearfix">
                        @if($post->status == '0')
                            <input id="post{{ $post->id }}" modelName="posts" type="checkbox" value="{{$post->id}}" class="make-switch active_post" data-on-text="<i class='fa fa-check'><i>" data-off-text="<i class='fa fa-ban'><i>" data-size="small" data-on-color="success" data-off-color="warning">
                        @else
                            <input id="post{{ $post->id }}" modelName="posts" type="checkbox" value="{{$post->id}}" checked class="make-switch active_post" data-on-text="<i class='fa fa-check'><i>" data-off-text="<i class='fa fa-ban'><i>" data-size="small" data-on-color="success" data-off-color="warning">
                        @endif
                        <a href="{!! route('admin.posts.show', [$post->id]) !!}" class="btn btn btn-xs grey-cascade">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{!! route('admin.posts.edit', [$post->id]) !!}" class="btn btn btn-xs blue">
                            <i class="fa fa-edit"></i>
                        </a>
                        {{--<a href="{!! route('admin.posts.duplicate', [$device->id]) !!}" class="btn btn btn-xs green-jungle">--}}
                        {{--<i class="fa fa-copy"></i>--}}
                        {{--</a>--}}
                        {{--<a href="#" class="btn btn btn-xs green">--}}
                        {{--<i class="fa fa-check"></i>--}}
                        {{--</a>--}}
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn btn-xs red', 'onclick' => "return confirm('".Lang::get('messages.are_you_sure')."')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
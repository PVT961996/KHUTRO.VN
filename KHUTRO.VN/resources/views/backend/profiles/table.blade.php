<table class="table table-responsive" id="profiles-table">
    <thead>
        <th>Title</th>
        <th>User Id</th>
        <th>Motel Category Id</th>
        <th>Short Description</th>
        <th>Image Title</th>
        <th>Address</th>
        <th>Area</th>
        <th>Province Id</th>
        <th>District Id</th>
        <th>Town Id</th>
        <th>Due Date</th>
        <th>Content</th>
        <th>Seo Title</th>
        <th>Seo Tag</th>
        <th>Seo Description</th>
        <th>Slug</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($profiles as $profile)
        <tr>
            <td>{!! $profile->title !!}</td>
            <td>{!! $profile->user_id !!}</td>
            <td>{!! $profile->motel_category_id !!}</td>
            <td>{!! $profile->short_description !!}</td>
            <td>{!! $profile->image_title !!}</td>
            <td>{!! $profile->address !!}</td>
            <td>{!! $profile->area !!}</td>
            <td>{!! $profile->province_id !!}</td>
            <td>{!! $profile->district_id !!}</td>
            <td>{!! $profile->town_id !!}</td>
            <td>{!! $profile->due_date !!}</td>
            <td>{!! $profile->content !!}</td>
            <td>{!! $profile->seo_title !!}</td>
            <td>{!! $profile->seo_tag !!}</td>
            <td>{!! $profile->seo_description !!}</td>
            <td>{!! $profile->slug !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.profiles.destroy', $profile->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.profiles.show', [$profile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.profiles.edit', [$profile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".Lang::get('messages.are_you_sure')."')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
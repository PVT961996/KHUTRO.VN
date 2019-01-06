<table class="table table-striped table-bordered table-hover" id="thanhModels-table">
    <thead>
    <tr>
        <th class="center">#</th>
        <th class="center">
            <input type="checkbox" name="check-all" id="check-all" class="icheck check-all"/>
        </th>
        <th>Name</th>
        <th>Group</th>
        <th>Email</th>
        <th>Age</th>
        <th>Sex</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Job</th>
        <th>Description</th>
        <th>Card Id</th>
        <th>Card Issued</th>
        <th>Action</th>
    </tr>

    </thead>

    <tbody>
    @if (count($users) == 0)
        <tr class="text-center">
            <td colspan="14">Không có bản ghi.</td>
        </tr>
    @else
        @foreach($users as $index => $user)
            <tr>
                <td class="center"><a href="{!! route('admin.users.show', [$user->id]) !!}" >{!! $index+1 !!}.</a></td>
                <td class="center"><input type="checkbox" name="ids[]" value="{{ $user->id }}" class="icheck check-single ids" form="items" /></td>
                <td>{!! $user->name !!}</td>
                <td>{!! toStringOf($user->groups,'name','show','admin.groups.show') !!}</td>
                <td>{!! $user->email !!}</td>
                <td>{!! $user->age !!}</td>
                @if($user->sex=='1')
                    <td> Nam </td>
                @elseif($user->sex=='0')
                    <td> Nữ </td>
                @else
                    <td> Khác </td>
                @endif

                <td>{!! $user->address !!}</td>
                <td>{!! $user->phone_number !!}</td>
                <td>{!! $user->job !!}</td>
                <td>{!! $user->description !!}</td>
                <td>{!! $user->card_id !!}</td>
                <td>{!! $user->issued_card !!}</td>
                <td class="center">
                    {!! Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class="clearfix">
                        @if($user->active == '0')
                            <input id="user{{ $user->id }}" modelName="users" type="checkbox" value="{{$user->id}}" class="make-switch active_user" data-on-text="<i class='fa fa-check'><i>" data-off-text="<i class='fa fa-ban'><i>" data-size="small" data-on-color="success" data-off-color="warning">
                        @else
                            <input id="user{{ $user->id }}" modelName="users" type="checkbox" value="{{$user->id}}" checked class="make-switch active_user" data-on-text="<i class='fa fa-check'><i>" data-off-text="<i class='fa fa-ban'><i>" data-size="small" data-on-color="success" data-off-color="warning">
                        @endif
                        <a href="{!! route('admin.users.show', [$user->id]) !!}" class="btn btn btn-xs grey-cascade">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{!! route('admin.users.edit', [$user->id]) !!}" class="btn btn btn-xs blue">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn btn-xs green-jungle">
                            <i class="fa fa-copy"></i>
                        </a>
                        {{--<a href="#" class="btn btn btn-xs green">--}}
                            {{--<i class="fa fa-check"></i>--}}
                        {{--</a>--}}
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn btn-xs red', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    @endif

    </tbody>
</table>
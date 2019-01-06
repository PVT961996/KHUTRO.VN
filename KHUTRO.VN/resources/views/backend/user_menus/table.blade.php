<table class="table table-striped table-bordered table-hover" id="actions-table">
    <thead>
    <tr>
        <th style="width: 200px"> <input type="checkbox" class="icheck allUserMenu" id="checkAllUserMenu" value="icheck"> </th>
        @foreach($tables as $table)
            <th colspan={{count($table->actions)}}> <input value="table{{$table->id}}"  type="checkbox" class="icheck headerTable" > {!! $table->name !!} </th>
        @endforeach
    </tr>
    <tr>
        <th>Name</th>
        @foreach($tables as $table)
            @if(count($table->actions)==0)
                <th></th>
            @else
                @foreach($table->actions as $action)
                    <td><input  type="checkbox" class="icheck headerAction table{{$table->id}}" value="table{{$table->id}}-action{{$action->id}}">{{$action->name}} </td>
                @endforeach
            @endif
        @endforeach
    </tr>

    <tr>
    @foreach($users as $key=>$user)
        <tr>
            <td><input type="checkbox" class="icheck headerUser" value="user{{$user->id}}"/><span data-toggle="tooltip" title="{{$user->age}} tuổi-Phone {{$user->phone}}- Email {{$user->email}}">{{$key+1}} : {!!$user->name!!}</span></td>

            @foreach($tables as $index => $table)
                @if(count($table->actions) == 0)
                    <td></td>
                @else
                    @foreach($table->actions as $action)
                        @if(in_array($user->id.'-'.$table->id.'-'.$action->id, $user_menu_locations))
                            <td><input index="{{$user->id}}-{{$table->id}}-{{$action->id}}" checked type="checkbox" class="user_menu_checkbox icheck user{{$user->id}} table{{$table->id}} table{{$table->id}}-action{{$action->id}}">  </td>
                        @else
                            <td><input index="{{$user->id}}-{{$table->id}}-{{$action->id}}" type="checkbox" class="user_menu_checkbox icheck user{{$user->id}} table{{$table->id}} table{{$table->id}}-action{{$action->id}}">  </td>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </tr>
        @endforeach
    </tr>
    </thead>
    <tbody>





    </tbody>
</table>
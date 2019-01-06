<table class="table table-striped table-bordered table-hover" id="tables-table">
    <thead>
        <th></th>
        <th></th>
        @foreach($tables as $index => $table)
            @if(in_array($table->id, $tables_with_checkall))
                <th colspan="{{$table->actions()->count()}}"><input checked type="checkbox" name="check-all-table" value="{{$table->id}}" class="icheck check-all-table check-all-table-{{$table->id}}"/>   {!! $table->name !!}</th>
            @else
                <th colspan="{{$table->actions()->count()}}"><input type="checkbox" name="check-all-table" value="{{$table->id}}" class="icheck check-all-table check-all-table-{{$table->id}}"/>   {!! $table->name !!}</th>
            @endif
        @endforeach
    </thead>
    <tbody>
        <tr>
            <th>Group</th>
            <th>#</th>
            @foreach($tables as $index => $table)
                <?php
                $actions = $table->actions()->get();
                ?>
                @if(count($actions) == 0)
                        <td></td>
                @else
                        @foreach($actions as $action)
                            @if(in_array($table->id.'-'.$action->id, $actions_tables_with_checkall))
                                <td><input checked type="checkbox" name="check-all-col" value="{{$table->id}}-{{$action->id}}" class="icheck check-single check-all-col check-all-col-{{$table->id}}-{{$action->id}} check-single-table check-single-table-{{$table->id}}"/>   {!! $action->name !!}</td>
                            @else
                                <td><input type="checkbox" name="check-all-col" value="{{$table->id}}-{{$action->id}}" class="icheck check-single check-all-col check-all-col-{{$table->id}}-{{$action->id}} check-single-table check-single-table-{{$table->id}}"/>   {!! $action->name !!}</td>
                            @endif
                        @endforeach
                @endif
            @endforeach
        </tr>
        @foreach($groups as $group)
            <tr>
                <td>{!!$group->name!!}</td>

                @if(in_array($group->id, $groups_with_checkall))
                    <td class="center"><input type="checkbox" checked name="check-all-row" value="{{ $group->id }}" class="icheck check-all-row  check-all-row-{{ $group->id }}" form="items" /></td>
                @else
                    <td class="center"><input type="checkbox" name="check-all-row" value="{{ $group->id }}" class="icheck check-all-row  check-all-row-{{ $group->id }}" form="items" /></td>
                @endif

                @foreach($tables as $index => $table)
                    <?php
                    $actions = $table->actions()->get();
                    ?>
                    @if(count($actions) == 0)
                        <td></td>
                    @else
                        @foreach($actions as $action)
                            <td class="center">
                            <?php
                                $group_menu_location = $group->id."-".$table->id."-".$action->id;
                            ?>
                            @if(in_array($group_menu_location, $group_menu_locations))
                                <input id="check_single" type="checkbox" checked name="ids[]" value="{{ $group->id }}-{{ $table->id }}-{{ $action->id }}" class="group_menu_checkbox icheck check-single check-single-row-{{ $group->id }} check-single-col-{{$table->id}}-{{$action->id}} check-single-table-{{ $table->id }} " form="items" />
                            @else
                                <input id="check_single" type="checkbox" name="ids[]" value="{{ $group->id }}-{{ $table->id }}-{{ $action->id }}" class="group_menu_checkbox icheck check-single check-single-row-{{ $group->id }} check-single-col-{{$table->id}}-{{$action->id}} check-single-table-{{ $table->id }} " form="items" />
                            @endif
                            </td>
                        @endforeach
                    @endif
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

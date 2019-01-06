{{--<table class="table table-responsive" id="motels-table">--}}
    {{--<thead>--}}
        {{--<th>Title</th>--}}
        {{--<th>Slug</th>--}}
        {{--<th>User Id</th>--}}
        {{--<th>Motel Category Id</th>--}}
        {{--<th>Min Price</th>--}}
        {{--<th>Max Price</th>--}}
        {{--<th>Area</th>--}}
        {{--<th>Address</th>--}}
        {{--<th>Province Id</th>--}}
        {{--<th>District Id</th>--}}
        {{--<th>Town Id</th>--}}
        {{--<th>Street Id</th>--}}
        {{--<th>Views</th>--}}
        {{--<th>Due Date</th>--}}
        {{--<th>Short Description</th>--}}
        {{--<th>Featured</th>--}}
        {{--<th>Status</th>--}}
        {{--<th>Image Title</th>--}}
        {{--<th>Config Price Id</th>--}}
        {{--<th>Deposits</th>--}}
        {{--<th>Original Id</th>--}}
        {{--<th>Seo Title</th>--}}
        {{--<th>Seo Tag</th>--}}
        {{--<th>Seo Description</th>--}}
        {{--<th colspan="3">Action</th>--}}
    {{--</thead>--}}
    {{--<tbody>--}}
    {{--@foreach($motels as $motel)--}}
        {{--<tr>--}}
            {{--<td>{!! $motel->title !!}</td>--}}
            {{--<td>{!! $motel->slug !!}</td>--}}
            {{--<td>{!! $motel->user_id !!}</td>--}}
            {{--<td>{!! $motel->motel_category_id !!}</td>--}}
            {{--<td>{!! $motel->min_price !!}</td>--}}
            {{--<td>{!! $motel->max_price !!}</td>--}}
            {{--<td>{!! $motel->area !!}</td>--}}
            {{--<td>{!! $motel->address !!}</td>--}}
            {{--<td>{!! $motel->province_id !!}</td>--}}
            {{--<td>{!! $motel->district_id !!}</td>--}}
            {{--<td>{!! $motel->town_id !!}</td>--}}
            {{--<td>{!! $motel->street_id !!}</td>--}}
            {{--<td>{!! $motel->views !!}</td>--}}
            {{--<td>{!! $motel->due_date !!}</td>--}}
            {{--<td>{!! $motel->short_description !!}</td>--}}
            {{--<td>{!! $motel->featured !!}</td>--}}
            {{--<td>{!! $motel->status !!}</td>--}}
            {{--<td>{!! $motel->image_title !!}</td>--}}
            {{--<td>{!! $motel->config_price_id !!}</td>--}}
            {{--<td>{!! $motel->deposits !!}</td>--}}
            {{--<td>{!! $motel->original_id !!}</td>--}}
            {{--<td>{!! $motel->seo_title !!}</td>--}}
            {{--<td>{!! $motel->seo_tag !!}</td>--}}
            {{--<td>{!! $motel->seo_description !!}</td>--}}
            {{--<td>--}}
                {{--{!! Form::open(['route' => ['admin.motels.destroy', $motel->id], 'method' => 'delete']) !!}--}}
                {{--<div class='btn-group'>--}}
                    {{--<a href="{!! route('admin.motels.show', [$motel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    {{--<a href="{!! route('admin.motels.edit', [$motel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>--}}
                    {{--{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".Lang::get('messages.are_you_sure')."')"]) !!}--}}
                {{--</div>--}}
                {{--{!! Form::close() !!}--}}
            {{--</td>--}}
        {{--</tr>--}}
    {{--@endforeach--}}
    {{--</tbody>--}}
{{--</table>--}}


<table class="table table-striped table-bordered table-hover" id="devices-table">
    <thead>
    <th class="center">#</th>
    <th class="center">
        <input type="checkbox" name="check-all" id="check-all" class="icheck check-all"/>
    </th>
    <th>@lang('messages.title')</th>
    <th>@lang('messages.auth')</th>
    <th>@lang('messages.address')</th>
    <th>@lang('messages.price')</th>
    <th>@lang('messages.motel_due_date')</th>
    <th>@lang('messages.active')</th>

    <th colspan="3">@lang('messages.action')</th>
    </thead>
    <tbody>
    @if (count($motels) == 0)
        <tr class="text-center">
            <td colspan="12">@lang('messages.no-items')</td>
        </tr>
    @else
        @foreach($motels as $index => $motel)
            <tr>
                <td class="center"><a href="{!! route('admin.motels.show', [$motel->id]) !!}" >{!! $index+1 !!}.</a></td>
                <td class="center"><input type="checkbox" name="ids[]" value="{{ $motel->id }}" class="icheck check-single" form="items" /></td>
                <td>{!! $motel->title !!}</td>
                <td>{!! $motel->user->name !!}</td>
                <td>{!! $motel->address !!}</td>

                @if($motel->configPrice()!=null)
                    <?php
                        $nameConfig = $motel->configPrice->name;
                        $min_price = $motel->min_price;
                        $max_price = $motel->max_price;
                    ?>


                    @if($min_price == $max_price)
                        <td>{{fomatPrice($min_price)}} ({{$nameConfig}})</td>
                    @else
                        <td>Từ: {{fomatPrice($min_price)}} ({{$nameConfig}}) Đến: {{fomatPrice($max_price)}} ({{$nameConfig}}) </td>
                    @endif
                @else
                    <td></td>
                @endif

                <td>{!! $motel->due_date !!}</td>
                <td>
                    @if($motel->status == '0')
                        <input id="motel{{ $motel->id }}"  type="checkbox" value="{{$motel->id}}" class="make-switch active_motel" data-on-text="<i class='fa fa-check'><i>" data-off-text="<i class='fa fa-ban'><i>" data-size="small" data-on-color="success" data-off-color="warning">
                    @else
                        <input id="motel{{ $motel->id }}"  type="checkbox" value="{{$motel->id}}" checked class="make-switch active_motel" data-on-text="<i class='fa fa-check'><i>" data-off-text="<i class='fa fa-ban'><i>" data-size="small" data-on-color="success" data-off-color="warning">
                    @endif
                </td>


                <td class="center">
                    {!! Form::open(['route' => ['admin.motels.destroy', $motel->id], 'method' => 'delete']) !!}
                    <div class="clearfix">
                        <a href="{!! route('admin.motels.show', [$motel->id]) !!}" class="btn btn btn-xs grey-cascade">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{!! route('admin.motels.edit', [$motel->id]) !!}" class="btn btn btn-xs blue">
                            <i class="fa fa-edit"></i>
                        </a>
                        {{--<a href="{!! route('admin.motels.duplicate', [$device->id]) !!}" class="btn btn btn-xs green-jungle">--}}
                            {{--<i class="fa fa-copy"></i>--}}
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





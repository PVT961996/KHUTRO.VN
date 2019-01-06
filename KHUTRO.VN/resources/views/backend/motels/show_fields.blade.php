<table class="table table-striped table-bordered table-hover">
    <tbody>
    <tr>
        <td> {!! Form::label('id', Lang::get('messages.id')) !!}</td>
        <td>{!! $motel->id !!}</td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('image', Lang::get('messages.image_title')) !!}</th>
        <td><img src="{!! $motel->image_title !!}" height="200px"></td>
    </tr>

    <tr>
        <td>{!! Form::label('title', Lang::get('messages.title')) !!}</td>
        <td>{!! $motel->title !!}</td>
    </tr>

    <tr>
        <td>{!! Form::label('user_id', Lang::get('messages.auth')) !!}</td>
        <td>{!! $motel->user->name !!}</td>
    </tr>
    <tr>
        <td>{!! Form::label('motel_category_id', Lang::get('messages.category')) !!}</td>
        <td>{!! $motel->motelCategory->name !!}</td>
    </tr>

    @if($motel->configPrice()!=null)
        <?php
        $nameConfig = $motel->configPrice->name;
        $min_price = $motel->min_price;
        $max_price = $motel->max_price;
        ?>
        @if($min_price == $max_price)
            <tr>
                <td>{!! Form::label('max_price', Lang::get('messages.price')) !!}</td>
                <td>{{fomatPrice($min_price)}} ({{$nameConfig}})</td>
            </tr>
        @else
            <tr>
                <td>{!! Form::label('max_price', Lang::get('messages.price')) !!}</td>
                <td>Từ: {{fomatPrice($min_price)}} ({{$nameConfig}}) Đến: {{fomatPrice($max_price)}} ({{$nameConfig}})</td>
            </tr>
        @endif
    @else
        <td>{!! Form::label('max_price', Lang::get('messages.price')) !!}</td>
        <td></td>
    @endif

    <tr>
        <td>{!! Form::label('area', Lang::get('messages.area')) !!}</td>
        <td>{!! $motel->area !!}</td>
    </tr>

    <tr>
        <td> {!! Form::label('province_id', Lang::get('messages.province')) !!}</td>
        <td>{!! $motel->province->name !!}</td>
    </tr>
    <tr>
        <td> {!! Form::label('district_id', Lang::get('messages.district')) !!}</td>
        <td> {!! $motel->district->name !!}</td>
    </tr>
    <tr>
        <td> {!! Form::label('town_id', Lang::get('messages.town')) !!}</td>
        <td> {!! $motel->town->name !!}</td>
    </tr>
    <tr>
        <td> {!! Form::label('street_id', Lang::get('messages.street')) !!}</td>
        <td> {!! $motel->street->name !!}</td>
    </tr>

    <tr>
        <td> {!! Form::label('views', Lang::get('messages.views')) !!}</td>
        <td> {!! $motel->views !!}</td>
    </tr>

    <tr>
        <td> {!! Form::label('seo_title', Lang::get('messages.seo_title')) !!}</td>
        <td> {!! $motel->seo_title !!}</td>
    </tr>
    <tr>
        <td> {!! Form::label('seo_tag', Lang::get('messages.seo_tag')) !!}</td>
        <td> {!! $motel->seo_tag !!}</td>
    </tr>

    <tr>
        <td>  {!! Form::label('seo_description',Lang::get('messages.seo_description')) !!}</td>
        <td> {!! $motel->seo_description !!}</td>
    </tr>
    <tr>
        <td>  {!! Form::label('created_at', Lang::get('messages.created_at')) !!}</td>
        <td> {!! $motel->created_at !!}</td>
    </tr>
    <tr>
        <td>  {!! Form::label('updated_at', Lang::get('messages.updated_at')) !!}</td>
        <td> {!! $motel->updated_at !!}</td>
    </tr>

    </tbody>
</table>

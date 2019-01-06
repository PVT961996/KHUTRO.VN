<div class="form-group col-sm-12">
    <label><b>Nhập các thông tin bắt buộc</b></label>
</div>
<!-- Title Field -->
<div class="form-group col-sm-12">
    {!! Form::label('title', Lang::get('messages.title')) !!}
    <label>Title <span class="required">(*)</span></label>
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
<!-- Image Title Field -->
<div class="form-group col-sm-12">
    <div class="form-group col-sm-6">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                @if(isset($motel))
                    @if(isset($motel->image_title))
                        <img style="width: 200px; height: 150px;" src="{!! $motel->image_title !!}">
                    @else
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                    @endif
                @endif

            </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
            <div>
                <span class="btn default btn-file">
                    <span class="fileinput-new"> @lang('messages.select_image_title') </span>
                    <span class="fileinput-exists"> @lang('messages.change') </span>
                     {{--<input name="image_title" type="file">--}}
                    @if(isset($motel))
                        @if(isset($motel->image_title))
                            <input name="image_title" type="file" href="{{$motel->image_title}}">
                        @else

                        @endif
                    @else
                        {!! Form::file('image_title',[]) !!}
                    @endif
                </span>
                <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> @lang('messages.delete') </a>
            </div>
        </div>
    </div>
</div>
<div>
    <div class="form-group col-sm-3" style="float: left">
        {!! Form::label('selectBoxPrice', Lang::get('messages.description_price')) !!}
        @if(isset($motel))
            @if(($motel->min_price))
                @if($motel->min_price==$motel->max_price)
                    {!! Form::select('selectBoxPrice[]', [1=>$selectBoxConfigPrice[1],2=>$selectBoxConfigPrice[2]], null, ['class'=> 'form-control config_price']) !!}
                @else
                    {!! Form::select('selectBoxPrice[]', [2=>$selectBoxConfigPrice[2],1=>$selectBoxConfigPrice[1]], null, ['class'=> 'form-control config_price']) !!}
                @endif
            @else
                {!! Form::select('selectBoxPrice[]', $selectBoxConfigPrice, null, ['class'=> 'form-control config_price']) !!}
            @endif
        @else
                {!! Form::select('selectBoxPrice[]', $selectBoxConfigPrice, null, ['class'=> 'form-control config_price']) !!}
        @endif

    </div>
    <div class="price_motel">
        @if(isset($motel->min_price))
            @if($motel->min_price==$motel->max_price)
                <div class="form-group col-sm-3 price_element"> <label for="min_price">Giá:</label> <input class="form-control" name="price" type="number"  value="{{$motel->min_price}}"> </div>
            @else
                <div class="form-group col-sm-3 price_element"> <label for="min_price">Từ:</label> <input class="form-control" name="min_price" type="number"  value="{{$motel->min_price}}"> </div>
                <div class="form-group col-sm-3 price_element"> <label for="min_price">Đến:</label> <input class="form-control" name="max_price" type="number"  value="{{$motel->max_price}}"> </div>

            @endif
        @else
        @endif
    </div>

    <div class="form-group col-sm-3" >
        @if(isset($motel->config_price_id))
            <label for="selectBoxTypePrice">Loại Giá</label>
            <select class="form-control" name="selectBoxTypePrice[configPrice]">
                @foreach($selectBoxTypePrice as $key=>$element)
                    @if($motel->config_price_id==$key)
                        <option selected="selected" value={{$key}}>{{$element}}</option>
                    @else
                        <option value={{$key}} >{{$element}}</option>
                    @endif
                @endforeach
            </select>
        @else
            {!! Form::label('selectBoxTypePrice', "Loại Giá") !!}
            {!! Form::select('selectBoxTypePrice[configPrice]', $selectBoxTypePrice, null, ['class'=> 'form-control']) !!}
        @endif
    </div>

    <div class="col-sm-12">
        <label style="float: right" id="infoPrice"><h6>Mô tả: Giá BĐS từ 1000 đ/người đến 2000 đ/người</h6></label>
    </div>


</div>




<!-- Area Field -->
<div class="form-group col-sm-6">
    {!! Form::label('area', Lang::get('messages.area_label')) !!}
    {!! Form::number('area', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', Lang::get('messages.address_description')) !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    <label><b>Chọn các thông tin sau (Rất quan trọng cho việc tìm kiếm trên web)</b></label>

</div>

<!-- Province Id Field -->
<div class="form-group col-sm-6">
    <label for="province_id">@lang('messages.province_label')</label>
    <select class="form-control selectBoxProvince" name="province_id">
        @if(isset($motel->province_id))
            @foreach($provinces as $province)
                @if($province->id===$motel->province_id)
                    <option selected="selected" value={{$province->id}} class="province">{{$province->name}}</option>
                @else
                    <option value={{$province->id}} class="province">{{$province->name}}</option>
                @endif
            @endforeach
        @else
            @foreach($provinces as $province)
                @if(trim($province->name)==='Hà Nội')
                    <option selected="selected" value={{$province->id}} class="province">Hà Nội</option>
                @else
                    <option value={{$province->id}} class="province">{{$province->name}}</option>
                @endif
            @endforeach
        @endif

    </select>
</div>

<!-- District Id Field -->
<div class="form-group col-sm-6">
    <label for="district_id">@lang('messages.district_label')</label>
    @if(isset($motel))
        <select @if(isset($motel->district_id)) district="{{$motel->district_id}}" @endif class="form-control selectBoxDistrict" name="district_id">
            {{--<option value="1" class="district">Hà Nội</option>--}}
        </select>
    @else
        <select class="form-control selectBoxDistrict" name="district_id">
            {{--<option value="1" class="district">Hà Nội</option>--}}
        </select>
    @endif

</div>

<!-- Town Id Field -->
<div class="form-group col-sm-6">
    <label for="town_id">@lang('messages.town_label')</label>
    @if(isset($motel))
        <select @if(isset($motel->town_id)) town="{{$motel->town_id}}" @endif class="form-control selectBoxTown" name="town_id">
            {{--<option value="1" class="town">Hà Nội</option>--}}
        </select>
    @else
        <select class="form-control selectBoxTown" name="town_id">
            {{--<option value="1" class="town">Hà Nội</option>--}}
        </select>
    @endif

</div>

<!-- Street Id Field -->
<div class="form-group col-sm-6">
    <label for="street_id">@lang('messages.street_label')</label>
    @if(isset($motel))
        <select @if(isset($motel->street_id)) street="{{$motel->street_id}}" @endif  class="form-control selectBoxStreet" name="street_id">
        </select>
    @else
        <select class="form-control selectBoxStreet" name="street_id">
        </select>
    @endif
</div>


<!-- Short Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('short_description', Lang::get('messages.short_description')) !!}
    {!! Form::text('short_description', null, ['class' => 'form-control']) !!}
</div>

<!-- Featured Field -->
<div class="form-group col-sm-6">
    {!! Form::label('featured', Lang::get('messages.featured_label')) !!}
    {!! Form::number('featured', null, ['class' => 'form-control']) !!}
</div>

<!-- Deposits Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deposits', Lang::get('messages.motel_deposits')) !!}
    {!! Form::text('deposits', null, ['class' => 'form-control']) !!}
</div>


{{--Thiet Bi của Bất Động Sản--}}
<div class="form-group col-sm-12">
    <label><b> Trang thiết bị, tiện ích của ngôi nhà</b></label>
</div>
<div class="p3_detail_item_ttb col-sm-12">
    <div class="rt_BD_InfoGeneral">
        <ul class="rt_lb_ContentListIcon" style="border-bottom: 1px solid #ebdebd;padding-bottom: 15px;margin-bottom: 15px">
            @if(isset($motel))
                @foreach($devices as $desvice)
                    @if(inArrObj($desvice->id,$current_devices))
                        <label><input type="checkbox" checked name="devices[]" value="{{ $desvice->id }}" class="icheck checkDevice"> {{$desvice->name}} </label>
                        <br>
                    @else
                        <label><input type="checkbox" name="devices[]" value="{{ $desvice->id }}" class="icheck checkDevice"> {{$desvice->name}} </label>
                        <br>
                    @endif
                @endforeach
            @else
                @foreach($devices as $desvice)
                    <label><input type="checkbox" name="devices[]" value="{{ $desvice->id }}" class="icheck checkDevice"> {{$desvice->name}} </label>
                    <br>
                @endforeach
            @endif

        </ul>
    </div>
</div>

{{--Dich Vu của Bất Động Sản--}}
<div class="form-group col-sm-12">
    <label><b> Dịch vụ của ngôi nhà</b></label>
</div>
<div class="p3_detail_item_ttb col-sm-12">
    <div class="rt_BD_InfoGeneral">
        <ul class="rt_lb_ContentListIcon" style="border-bottom: 1px solid #ebdebd;padding-bottom: 15px;margin-bottom: 15px">
            @if(isset($motel))
                @foreach($sevices as $sesvice)
                    @if(inArrObj($sesvice->id,$current_sevices))
                        <label><input type="checkbox" checked name="sevices[]" value="{{ $sesvice->id }}" class="icheck checkDevice"> {{$sesvice->name}} </label>
                        <br>
                    @else
                        <label><input type="checkbox" name="sevices[]" value="{{ $sesvice->id }}" class="icheck checkDevice"> {{$sesvice->name}} </label>
                        <br>
                    @endif
                @endforeach
            @else
                @foreach($sevices as $sesvice)
                    <label><input type="checkbox" name="sevices[]" value="{{ $sesvice->id }}" class="icheck checkDevice"> {{$sesvice->name}} </label>
                    <br>
                @endforeach
            @endif
        </ul>
    </div>
</div>


{{--DIV chứa tất cả các trường cấu hình tương ứng với danh mục nào--}}
<div class="form-group col-sm-12">
    <label hidden id="label_info_category"><b>Thông tin đặc thù cho danh mục bất động sản</b></label>
</div>
<div class="col-sm-12" id="add" >
    @if(isset($motel))
        @foreach($fieldsConfig as $motelCategoryId=>$fields)
            @if($motelCategoryId==$current_category_id)
                <div id="configMotelCategory{{$motelCategoryId}}" class="configMotelCategory">
                    @foreach($fields as $field)
                        {!! $field !!}
                    @endforeach
                </div>
            @else
                <div hidden id="configMotelCategory{{$motelCategoryId}}" class="configMotelCategory">
                    @foreach($fields as $field)
                        {!! $field !!}
                    @endforeach
                </div>
            @endif
        @endforeach
    @else
        @foreach($fieldsConfig as $motelCategoryId=>$fields)
            <div hidden id="configMotelCategory{{$motelCategoryId}}" class="configMotelCategory">
                @foreach($fields as $field)
                    {!! $field !!}
                @endforeach
            </div>
        @endforeach
    @endif
</div>

<div class="form-group col-sm-12">
    <label><b>Thông tin SEO</b></label>
</div>

<!-- Seo Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('seo_title',Lang::get('messages.seo_title')) !!}
    {!! Form::text('seo_title', null, ['class' => 'form-control']) !!}
</div>

<!-- Seo Tag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('seo_tag', Lang::get('messages.seo_tag')) !!}
    {!! Form::text('seo_tag', null, ['class' => 'form-control']) !!}
</div>

<!-- Seo Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('seo_description', Lang::get('messages.seo_description')) !!}
    {!! Form::text('seo_description', null, ['class' => 'form-control']) !!}
</div>




<div class="form-group col-sm-12">
    <label><b>Click vào vùng trống dưới đây để upload nhiều ảnh mô tả cho bất động sản (giữ Ctrl để chọn nhiều)</b></label>
    <div action="/backend/theme/assets/global/plugins/dropzone/upload.php" class="dropzone dropzone-file-area dz-clickable" id="my-dropzone" style="width: 500px; margin-top: 50px;">
        <input type="file" name="uploaded_file[]" multiple="multiple">
        <div class="dz-default dz-message"><span></span></div>
    </div>
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    <div class="form-actions">
        <div class="row  col-md-offset-0">
            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white blue-steel','name'=>'save','value'=>'save'] )  }}
            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save_edit'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green','name'=>'save','value'=>'save_edit'] )  }}
            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save_new'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green-jungle','name'=>'save','value'=>'save_new'] )  }}
            <a href="{!! route('admin.motels.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> Back</a>
        </div>
    </div>
</div>













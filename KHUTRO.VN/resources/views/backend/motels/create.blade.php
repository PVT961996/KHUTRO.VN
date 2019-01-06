@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-9">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-equalizer font-red-sunglo"></i>
                        <span class="caption-subject font-red-sunglo bold uppercase">@lang('messages.add_motel')</span>
                    </div>
                    <div class="form-actions">
                        <div class="row  pull-right">
                            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white blue-steel','name'=>'save','value'=>'save','form'=>'form_motel_create'] )  }}
                            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save_edit'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green','name'=>'save','value'=>'save_edit','form'=>'form_motel_create'] )  }}
                            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save_new'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green-jungle','name'=>'save','value'=>'save_new','form'=>'form_motel_create'] )  }}
                            <a href="{!! route('admin.motels.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> @lang('messages.back')</a>
                        </div>
                    </div>
                </div>
                @include('flash::message')
                <div>
                    @include('metronic-templates::common.errors')
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        {!! Form::open(['route' => 'admin.motels.store','id'=>'form_motel_create','enctype'=>'multipart/form-data','files'=>true]) !!}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('backend.motels.fields')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <label>
                            <span class="caption-subject font-red-sunglo bold ">@lang('messages.category') ({{count($motelCategories)}})</span>
                        </label>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="input-group">
                        <div class="icheck-list">
                            @foreach($motelCategories as $category)
                                <label><input type="checkbox" name="category_ids[]" value="{{ $category->id }}" form="form_motel_create" class="icheck checkboxMotelCategory"> {{$category->name}} </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="configHtml" @if(isset($configHtml['2'])) checkboxOnlySelectOne="{{$configHtml['2']}}"@endif  @if(isset($configHtml['1'])) checkboxMultip="{{$configHtml['1']}}"@endif @if(isset($configHtml['3'])) selectbox="{{$configHtml['3']}}"@endif  @if(isset($configHtml['4'])) inputNumber="{{$configHtml['4']}}"@endif  @if(isset($configHtml['5'])) inputText="{{$configHtml['5']}}"@endif   @if(isset($configHtml['6'])) inputDateTime="{{$configHtml['6']}}"@endif  ></div>
@endsection

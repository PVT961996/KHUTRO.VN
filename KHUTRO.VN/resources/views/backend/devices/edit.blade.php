@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-equalizer font-red-sunglo"></i>
                        <span class="caption-subject font-red-sunglo bold uppercase">@lang('messages.device')</span>
                    </div>
                    <div class="form-actions">
                        <div class="row  pull-right">
                            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white blue-steel','name'=>'save','value'=>'save','form'=>'form_device'] )  }}
                            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save_edit'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green','name'=>'save','value'=>'save_edit','form'=>'form_device'] )  }}
                            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save_new'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green-jungle','name'=>'save','value'=>'save_new','form'=>'form_device'] )  }}
                            <a href="{!! route('admin.devices.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> @lang('messages.back')</a>
                        </div>
                    </div>
                </div>
                @include('flash::message')
                <div>
                    @include('metronic-templates::common.errors')
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        @if (isset($type) && $type == 'DUPLICATE')
                            {!! Form::model($device, ['id' => 'form_device', 'route' => ['admin.devices.store'],'enctype'=>'multipart/form-data']) !!}
                        @else
                            {!! Form::model($device, ['id' => 'form_device', 'route' => ['admin.devices.update', $device->id], 'method' => 'patch','enctype'=>'multipart/form-data']) !!}
                        @endif
                        @include('backend.devices.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
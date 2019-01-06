@extends('layouts.app')

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">DeviceMotel</span>
        </div>
    </div>
    <div>
        @include('metronic-templates::common.errors')
    </div>
    <div class="portlet-body form">
        <div class="row">
           {!! Form::model($deviceMotel, ['route' => ['admin.deviceMotels.update', $deviceMotel->id], 'method' => 'patch']) !!}

            @include('backend.device_motels.fields')

           {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
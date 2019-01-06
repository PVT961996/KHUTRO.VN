@extends('layouts.app')

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Menu</span>
        </div>
    </div>
    <div>
        @include('metronic-templates::common.errors')
    </div>
    <div class="portlet-body form">
        <div class="row">
           {!! Form::model($menu, ['route' => ['admin.menus.update', $menu->id], 'method' => 'patch']) !!}

            @include('backend.menus.fields')

           {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
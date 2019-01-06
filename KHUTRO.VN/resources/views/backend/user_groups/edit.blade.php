@extends('layouts.app')

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">UserGroup</span>
        </div>
    </div>
    <div>
        @include('metronic-templates::common.errors')
    </div>
    <div class="portlet-body form">
        <div class="row">
           {!! Form::model($userGroup, ['route' => ['admin.userGroups.update', $userGroup->id], 'method' => 'patch']) !!}

            @include('backend.user_groups.fields')

           {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
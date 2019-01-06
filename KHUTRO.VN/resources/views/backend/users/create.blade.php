@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-9">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-equalizer font-red-sunglo"></i>
                        <span class="caption-subject font-red-sunglo bold uppercase">User</span>
                    </div>
                    <div class="form-actions">
                        <div class="row  pull-right">
                            {{ Form::button('<i class="fa fa-save"></i> Save', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white blue-steel','name'=>'save','value'=>'save','form'=>'form_user_create'] )  }}
                            {{ Form::button('<i class="fa fa-save"></i> Save & Edit', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green','name'=>'save','value'=>'save_edit','form'=>'form_user_create'] )  }}
                            {{ Form::button('<i class="fa fa-save"></i>  Save & New', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green-jungle','name'=>'save','value'=>'save_new','form'=>'form_user_create'] )  }}
                            <a href="{!! route('admin.users.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> Back</a>
                        </div>
                    </div>
                </div>
                @include('flash::message')
                <div>
                    @include('metronic-templates::common.errors')
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        {!! Form::open(['route' => 'admin.users.store','id'=>'form_user_create', 'enctype'=>'multipart/form-data']) !!}
                            @include('backend.users.fields')
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
                            <input type="checkbox" class="icheck check-all">
                            <span class="caption-subject font-red-sunglo bold uppercase">Groups ({{count($groups)}})</span>
                        </label>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="input-group">
                        <div class="icheck-list">
                            @foreach($groups as $group)
                                <label><input type="checkbox" name="group_ids[]" value="{{ $group->id }}" form="form_user_create" class="icheck check-single"> {{$group->name}} </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--<div id="tree_2" class="tree-demo"> </div>--}}
    </div>
@endsection

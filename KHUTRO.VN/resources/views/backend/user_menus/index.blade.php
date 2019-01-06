@extends('layouts.app')

@section('content')
<div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-red-sunglo"></i>
                <a href="{!! route('admin.userMenus.index')!!}"><span class="caption-subject font-red-sunglo bold uppercase">Phân Quyền Người Dùng</span></a>
            </div>
        </div>
        @include('flash::message')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-header ">
                {!! Form::open(['method' => 'GET','route' => 'admin.userMenus.index','role' => 'search']) !!}
                    <div class="form-group form-inline pull-left">
                        {!! Form::text('search[name]', null, ['class' => 'form-control', 'placeholder' => 'Tên...']) !!}
                        {!! Form::text('search[table]', null, ['class' => 'form-control', 'placeholder' => 'Table...']) !!}
                        {!! Form::button('<i class="fa fa-search"></i> '.' Tìm Kiếm...', ['class' => ' btn btn-primary','type'=>'submit']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="box-body">
                <div class="table-scrollable">
                    @include('backend.user_menus.table')
                </div>

            </div>
        </div>
 </div>
@endsection


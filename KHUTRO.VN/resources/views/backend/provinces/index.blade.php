@extends('layouts.app')

@section('content')
<div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-red-sunglo"></i>
                <span class="caption-subject font-blue-sunglo bold uppercase"> @lang("messages.province_title")</span>
            </div>

            <div class="actions">
                <a href="{!! route('admin.provinces.create') !!}" class="btn btn-default font-white blue-steel">
                    <i class="fa fa-plus"></i> @lang("messages.add") </a>
                <button form="items" class="btn btn-default font-white green" name="submit_type" value="ACTIVE_MULTI"><i class="fa fa-check "></i> @lang("messages.actived") </button>
                <button form="items" class="btn btn-default font-white yellow-lemon" name="submit_type" value="INACTIVE_MULTI"><i class="fa fa-ban "></i> @lang("messages.inactive") </button>
                <button onclick="delete_multi_confirm()" form="items" class="btn btn-default font-white red" name="submit_type" value="DELETE_MULTI"><i class="fa fa-trash "></i> @lang("messages.delete_multip") </button>

                <div class="btn-group">
                    <a class="btn btn-default " href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-share" aria-hidden="true"></i> @lang("messages.others")
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <form id="form_export_to_excel" style="display: inline" action="{{ route('admin.provinces.export') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="type" value="xls">
                            </form>
                            <a type="submit" onclick="$('#form_export_to_excel').submit();">
                                <i class="fa fa-file-excel-o"></i> @lang("messages.excel") </a>
                        </li>
                        <li>
                            <form id="form_export_to_csv" style="display: inline" action="{{ route('admin.provinces.export') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="type" value="csv">
                            </form>
                            <a type="submit" onclick="$('#form_export_to_csv').submit();">
                                <i class="fa fa-file-text-o"></i> @lang("messages.csv") </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-print"></i> @lang("messages.print") </a>
                        </li>
                    </ul>
                </div>

                <a class="btn btn-circle btn-icon-only btn-default reload" href="{!! route('admin.provinces.index') !!}" data-original-title="Reload" title="Reload"> <i class="fa fa-repeat"></i></a>
                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>

                {!! Form::open(['id' =>'items', 'route' => ['admin.provinces.common_action', 'MULTI']]) !!}
                {!! Form::close() !!}
            </div>
        </div>
        @include('flash::message')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-header">
                {!! Form::open(['method'=>'GET','url'=>'/admin/provinces','role'=>'search'])  !!}
                <div class="form_province form-inline pull-left">
                    {!! Form::text('search[id]',null,['class'=> 'form-control', 'placeholder' => Lang::get('messages.province_search_id_placeholder') ]) !!}
                    {!! Form::text('search[name]',null,['class'=> 'form-control', 'placeholder' => Lang::get('messages.province_search_name_placeholder') ]) !!}
                    {!! Form::text('search[description]',null,['class'=> 'form-control', 'placeholder' => Lang::get('messages.province_search_description_placeholder') ]) !!}
                    {{ Form::button('<i class="fa fa-search"></i> '.Lang::get('messages.search'), array('class'=>'btn btn-primary', 'type'=>'submit')) }}
                </div>
                {!! Form::close() !!}
            </div>
            <div class="box-body">
                <div class="table-scrollable">
                    @include('backend.provinces.table')
                </div>  
                    @if($provinces->hasPages())
                        <div class="box-footer">
                            {!! $provinces->appends(['search' => Request::get('search')])->render() !!}
                        </div>
                    @endif
            </div>
        </div>
 </div>
@endsection
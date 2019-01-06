@extends('layouts.app')
@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-th font-blue-steel" aria-hidden="true"></i>
                <span class="caption-subject font-blue-steel bold uppercase">Pages</span>
            </div>

            <div class="actions">
                <a href="{!! route('admin.pages.create') !!}" class="btn btn-default font-white blue-steel">
                    <i class="fa fa-plus"></i> Add </a>
                <button disabled form="items" class="btn btn-default font-white green" name="submit_type" value="ACTIVE_MULTI"><i class="fa fa-check "></i> Actived </button>
                <button disabled form="items" class="btn btn-default font-white yellow-lemon" name="submit_type" value="INACTIVE_MULTI"><i class="fa fa-ban "></i> Inactive </button>
                <button onclick="delete_multi_confirm()" form="items" class="btn btn-default font-white red" name="submit_type" value="DELETE_MULTI"><i class="fa fa-trash "></i> Delete </button>

                <div class="btn-group">
                    <a class="btn btn-default " href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-share" aria-hidden="true"></i> Others
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-file-excel-o"></i> Excel </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-file-text-o"></i> Csv </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-print"></i> Print </a>
                        </li>
                    </ul>
                </div>
                <a class="btn btn-icon-only btn-default reload" href="{!! route('admin.pages.index') !!}" data-original-title="Reload" title="Reload"> <i class="fa fa-repeat"></i></a>
                <a class="btn btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                {!! Form::open(['id' =>'items', 'route' => ['admin.pages.common_action', 'MULTI']]) !!}
                {!! Form::close() !!}
            </div>
        </div>
        @include('flash::message')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-header">
                {!! Form::open(['method' => 'GET','route' => 'admin.pages.index','role' => 'search']) !!}
                <div class="form-group form-inline pull-left">
                    {!! Form::text('search[title]', null, ['class' => 'form-control', 'placeholder' => 'Nhập tên tìm kiếm']) !!}
                    {!! Form::button('<i class="fa fa-search"></i> '.'Tìm Kiếm...', ['class' => 'btn btn-primary','type'=>'submit']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <div class="box-body">
                <div class="table-scrollable">
                    @include('backend.pages.table')
                </div>
            </div>
            @if($pages->hasPages())
                <div class="box-footer">
                    {!! $pages->appends(['search' => Request::get('search')])->render() !!}
                </div>
            @endif
        </div>
    </div>
@endsection





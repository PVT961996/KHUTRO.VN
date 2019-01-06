@extends('layouts.app')

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-th font-blue-steel" aria-hidden="true"></i>
            <span class="caption-subject font-blue-steel bold uppercase">Tables</span>
        </div>

        <div class="actions">
            @if(hasRole('Tables','create'))
                <a href="{!! route('admin.tables.create') !!}" class="btn btn-default font-white blue-steel">
                    <i class="fa fa-plus"></i> Add </a>
            @endif
            <a href="{!! route('admin.tables.create') !!}" class="btn btn-default font-white green">
                <i class="fa fa-check "></i> Actived </a>
            <a href="{!! route('admin.tables.create') !!}" class="btn btn-default font-white yellow">
                <i class="fa fa-ban "></i> Inactive </a>
            <button onclick="delete_multi_confirm()" form="items" class="btn btn-default font-white red" name="submit_type" value="DELETE_MULTI"><i class="fa fa-trash "></i> Delete </button>


            <div class="btn-group">
                <a class="btn btn-default " href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-share" aria-hidden="true"></i> Others
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <form id="form_export_to_excel" style="display: inline" action="{{ route('admin.tables.export') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="type" value="xls">
                        </form>
                        <a type="submit" onclick="$('#form_export_to_excel').submit();">
                            <i class="fa fa-file-excel-o"></i> Excel </a>
                    </li>
                    <li>
                        <form id="form_export_to_csv" style="display: inline" action="{{ route('admin.tables.export') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="type" value="csv">
                        </form>
                        <a type="submit" onclick="$('#form_export_to_csv').submit();">
                            <i class="fa fa-file-text-o"></i> Csv </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="fa fa-print"></i> Print </a>
                    </li>
                </ul>
            </div>
            <a class="btn btn-icon-only btn-default reload" href="{!! route('admin.tables.index') !!}" data-original-title="Reload" title="Reload"> <i class="fa fa-repeat"></i></a>
            <a class="btn btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
            {!! Form::open(['id' =>'items', 'route' => ['admin.tables.destroy', 'MULTI'], 'method' => 'delete']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    @include('flash::message')
    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-header">
            {!! Form::open(['method' => 'GET','route' => 'admin.tables.index','role' => 'search']) !!}
            <div class="form-group form-inline pull-left">
                {!! Form::text('search[name]', null, ['class' => 'form-control', 'placeholder' => 'Nhập tên tìm kiếm']) !!}
                {!! Form::button('<i class="fa fa-search"></i> '.'Tìm Kiếm...', ['class' => 'btn btn-primary','type'=>'submit']) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="box-body">
            <div class="table-scrollable">
                @include('backend.tables.table')
            </div>
        </div>
        @if($tables->hasPages())
            <div class="box-footer">
                {!! $tables->appends(['search' => Request::get('search')])->render() !!}
            </div>
        @endif
    </div>
</div>
@endsection


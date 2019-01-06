@extends('layouts.app')

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-th font-blue-steel" aria-hidden="true"></i>
                <span class="caption-subject font-blue-steel bold uppercase">@lang('messages.motel')</span>
                {{--{!! Breadcrumbs::render('') !!}--}}
            </div>

            <div class="actions">
                <a href="{!! route('admin.motels.create') !!}" class="btn btn-default font-white blue-steel">
                    <i class="fa fa-plus"></i> @lang('messages.add') </a>
                {{--<a href="{!! route('admin.motels.create') !!}" class="btn btn-default font-white blue-steel">--}}
                {{--<i class="fa fa-plus"></i> @lang('messages.actice') </a>--}}
                {{--<a href="{!! route('admin.motels.create') !!}" class="btn btn-default font-white blue-steel">--}}
                {{--<i class="fa fa-plus"></i> @lang('messages.inactice') </a>--}}

                {{ Form::button('<i class="fa fa-trash"></i> '.Lang::get('messages.delete'), array('class'=>'btn btn-default font-white red','form'=>'items', 'onclick' => "var r = confirm('".Lang::get('messages.are_you_sure')."'); if (r == true) {
                $('#items').submit();}")) }}
                <div class="btn-group">
                    <a class="btn btn-default " href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-share" aria-hidden="true"></i> @lang('messages.others')
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <form id="form_export_to_excel" style="display: inline" action="{{ route('admin.users.export') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="type" value="xls">
                            </form>
                            <a type="submit" onclick="$('#form_export_to_excel').submit();">
                                <i class="fa fa-file-excel-o"></i> Excel </a>
                        </li>
                        <li>
                            <form id="form_export_to_csv" style="display: inline" action="{{ route('admin.users.export') }}" method="POST">
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


                <a class="btn btn-icon-only btn-default reload" href="{!! route('admin.motels.index') !!}" data-original-title="Reload" title="Reload"> <i class="fa fa-repeat"></i></a>
                <a class="btn btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
            </div>
        </div>
        @include('flash::message')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-header ">
                {!! Form::open(['method' => 'GET','route' => 'admin.motels.index','role' => 'search']) !!}
                <div class="form-group form-inline pull-left">
                    {!! Form::text('search[title]', null, ['class' => 'form-control', 'placeholder' => 'Tiêu đề...']) !!}
                    {!! Form::text('search[user]', null, ['class' => 'form-control', 'placeholder' => 'Tác giả...']) !!}
                    {!! Form::select('search[category]', $selectBoxCategory, null, ['class'=> 'form-control']) !!}
                    {!! Form::button('<i class="fa fa-search"></i> '.Lang::get('messages.search'), ['class' => ' btn btn-primary','type'=>'submit']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <div class="box-body">
                <div class="table-scrollable">
                    {!! Form::open(['id' =>'items', 'route' => ['admin.motels.destroy', 'MULTI'], 'method' => 'delete']) !!}
                    {!! Form::close() !!}
                    @include('backend.motels.table')
                </div>
            </div>
            @if($motels->hasPages())
                <div class="box-footer">
                    {!! $motels->appends(['search' => Request::get('search')])->render() !!}
                </div>
            @endif
        </div>
    </div>
@endsection


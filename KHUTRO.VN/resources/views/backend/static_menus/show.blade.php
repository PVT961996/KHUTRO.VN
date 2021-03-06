@extends('layouts.app')

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-red-sunglo"></i>
                <span class="caption-subject font-red-sunglo bold uppercase">STATIC MENUS</span>
            </div>

            <div class="actions">
                <a href="{!! route('admin.staticMenus.edit', $staticMenu->id) !!}" class="btn btn-default font-white green">
                    <i class="fa fa-edit"></i> Edit </a>
                <a href="{!! route('admin.staticMenus.create') !!}" class="btn btn-default font-white blue-steel">
                    <i class="fa fa-plus"></i> New </a>
                <a href="{!! route('admin.staticMenus.index') !!}" class="btn btn-default">
                    <i class="fa fa-reply "></i> Back </a>
            </div>
        </div>
        <div>
            @include('metronic-templates::common.errors')
        </div>
        <div class="portlet-body form">
            <div class="row" style="padding-left: 15px; padding-right: 15px;">
                @include('backend.static_menus.show_fields')
                <a href="{!! route('admin.staticMenus.edit', $staticMenu->id) !!}" class="btn btn-default font-white green">
                    <i class="fa fa-edit"></i> Edit </a>
                <a href="{!! route('admin.staticMenus.create') !!}" class="btn btn-default font-white blue-steel">
                    <i class="fa fa-plus"></i> New </a>
                <a href="{!! route('admin.staticMenus.index') !!}" class="btn btn-default">
                    <i class="fa fa-reply "></i> Back </a>
            </div>
        </div>
    </div>
@endsection


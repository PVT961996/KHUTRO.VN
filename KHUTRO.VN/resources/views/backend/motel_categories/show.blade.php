@extends('layouts.app')


@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-red-sunglo"></i>
                <span class="caption-subject font-red-sunglo bold uppercase">@lang('messages.motel_category')</span>
            </div>

            <div class="actions">
                <a href="{!! route('admin.motelCategories.edit', [$motelCategory->id]) !!}" class="btn btn-default font-white green">
                    <i class="fa fa-edit"></i> @lang('messages.edit') </a>
                <a href="{!! route('admin.motelCategories.create') !!}" class="btn btn-default font-white blue-steel">
                    <i class="fa fa-plus"></i> @lang("messages.new") </a>
                <a href="{!! route('admin.motelCategories.index') !!}" class="btn btn-default">
                    <i class="fa fa-reply "></i> @lang("messages.back") </a>
            </div>
        </div>
        <div>
            @include('metronic-templates::common.errors')
        </div>
        <div class="portlet-body form">
            <div class="row" style="padding-left: 15px; padding-right: 15px;">
                @include('backend.motel_categories.show_fields')
                <a href="{!! route('admin.motelCategories.edit', [$motelCategory->id]) !!}" class="btn btn-default btn-sm font-white green"><i class="fa fa-edit"></i>  @lang("messages.edit")</a>
                <a href="{!! route('admin.motelCategories.create') !!}" class="btn btn-default btn-sm font-white blue-steel"><i class="fa fa-plus"></i>  @lang("messages.new") </a>
                <a href="{!! route('admin.motelCategories.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply "></i>  @lang("messages.back")</a>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-th font-blue-steel" aria-hidden="true"></i>
                <span class="caption-subject font-blue-steel bold uppercase">Groups</span>
            </div>

            <div class="actions">
                <a href="{!! route('admin.groups.edit', [$group->id]) !!}" class="btn btn-default font-white green">
                    <i class="fa fa-edit"></i> Edit </a>
                <a href="{!! route('admin.groups.create') !!}" class="btn btn-default font-white blue-steel">
                    <i class="fa fa-plus"></i> New </a>
                <a href="{!! route('admin.groups.index') !!}" class="btn btn-default">
                    <i class="fa fa-reply "></i> Back </a>
            </div>
        </div>
        <div>
            @include('metronic-templates::common.errors')
        </div>
        <div class="portlet-body form">
            <div class="row" style="padding-left: 15px; padding-right: 15px;">
                @include('backend.groups.show_fields')
                <a href="{!! route('admin.groups.edit', [$group->id]) !!}" class="btn btn-default btn-sm font-white green"><i class="fa fa-edit"></i> Edit</a>
                <a href="{!! route('admin.groups.create') !!}" class="btn btn-default btn-sm font-white blue-steel"><i class="fa fa-plus"></i> New </a>
                <a href="{!! route('admin.groups.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply "></i> Back</a>
            </div>
        </div>
    </div>
@endsection

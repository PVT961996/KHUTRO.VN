<li class="{!! Request::is('home*') ? 'active' : '' !!}">
    <a href="{!! url('/home') !!}" class="nav-link nav-toggle">
        <i class="fa fa-tachometer" aria-hidden="true"></i>
        <span class="title">@lang("messages.home")</span>
    </a>
</li>


<li class="nav-item start ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-home" aria-hidden="true"></i>
        <span class="title"> @lang("messages.motels_manage") </span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="{!! Request::is('motelCategories*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.motelCategories.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.motel_categories")</span></a>
        </li>
        <li class="{!! Request::is('motels*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.motels.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.motels")</span></a>
        </li>

        <li class="{!! Request::is('configMotelCategories*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.configMotelCategories.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.config_motel_categories")</span></a>
        </li>

        <li class="{!! Request::is('profiles*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.profiles.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.profiles")</span></a>
        </li>
    </ul>
</li>


<li class="nav-item start ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-map-marker" aria-hidden="true"></i>
        <span class="title"> @lang("messages.motels_address_manage")</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="{!! Request::is('provinces*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.provinces.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.provinces")</span></a>
        </li>

        <li class="{!! Request::is('districts*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.districts.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.districts")</span></a>
        </li>

        <li class="{!! Request::is('towns*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.towns.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.towns")</span></a>
        </li>

        <li class="{!! Request::is('streets*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.streets.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.streets")</span></a>
        </li>
    </ul>
</li>


<li class="nav-item start ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
        <span class="title"> @lang("messages.new_manage")</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="{!! Request::is('posts*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.posts.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.posts")</span></a>
        </li>
        <li class="{!! Request::is('postCategories*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.postCategories.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.post_categories")</span></a>
        </li>
    </ul>
</li>



<li class="nav-item start ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-comments-o" aria-hidden="true"></i>
        <span class="title"> @lang("messages.feedback_manage")</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="{!! Request::is('feedbackMotelTypes*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.feedbackMotelTypes.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.feedback_motel_types")</span></a>
        </li>
        <li class="{!! Request::is('feedbackMotels*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.feedbackMotels.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.feedback_motels")</span></a>
        </li>
        <li class="{!! Request::is('feedbackProfiles*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.feedbackProfiles.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.feedback_profiles")</span></a>
        </li>
        <li class="{!! Request::is('commentPosts*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.commentPosts.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.comment_posts")</span></a>
        </li>
    </ul>
</li>



<li class="nav-item start ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-cogs" aria-hidden="true"></i>
        <span class="title"> @lang("messages.config_manage")</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="{!! Request::is('devices*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.devices.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.devices")</span></a>
        </li>
        <li class="{!! Request::is('sevices*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.sevices.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.sevices")</span></a>
        </li>
        <li class="{!! Request::is('configPrices*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.configPrices.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.config_prices")</span></a>
        </li>
    </ul>
</li>


<li class="nav-item start ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-users" aria-hidden="true"></i>
        <span class="title"> @lang("messages.auth_manage")</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="{!! Request::is('groups*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.groups.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.groups")</span></a>
        </li>
        <li class="{!! Request::is('users*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.users.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.users")</span></a>
        </li>
        <li class="{!! Request::is('tables*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.tables.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.tables")</span></a>
        </li>
        <li class="{!! Request::is('actions*') ? 'active' : '' !!}">
            <a class="nav-link nav-toggle" href="{!! route('admin.actions.index') !!}">
                <i class="fa fa-edit"></i>
                <span  class="title">@lang("messages.actions")</span></a>
        </li>
    </ul>
</li>

<li class="{!! Request::is('staticMenus*') ? 'active' : '' !!}">
    <a class="nav-link nav-toggle" href="{!! route('admin.staticMenus.index') !!}">
        <i class="fa fa-qrcode" aria-hidden="true"></i>
        <span  class="title">@lang("messages.static_menus")</span></a>
</li>

<li class="{!! Request::is('tags*') ? 'active' : '' !!}">
    <a class="nav-link nav-toggle" href="{!! route('admin.tags.index') !!}">
        <i class="fa fa-tags" aria-hidden="true"></i>
    <span  class="title">@lang("messages.tags")</span></a>
</li>

<li class="{!! Request::is('pages*') ? 'active' : '' !!}">
    <a class="nav-link nav-toggle" href="{!! route('admin.pages.index') !!}">
        <i class="fa fa-object-group" aria-hidden="true"></i>
    <span  class="title">@lang("messages.pages")</span></a>
</li>


<li class="{!! Request::is('histories*') ? 'active' : '' !!}">
    <a class="nav-link nav-toggle" href="{!! route('admin.histories.index') !!}">
        <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
        <span  class="title">@lang("messages.histories")</span></a>
</li>


{{--<li class="{!! Request::is('deviceMotels*') ? 'active' : '' !!}">--}}
    {{--<a class="nav-link nav-toggle" href="{!! route('admin.deviceMotels.index') !!}">--}}
    {{--<i class="fa fa-edit"></i>--}}
    {{--<span  class="title">@lang("messages.home")</span></a>--}}
{{--</li>--}}

{{--<li class="{!! Request::is('seviceMotels*') ? 'active' : '' !!}">--}}
    {{--<a class="nav-link nav-toggle" href="{!! route('admin.seviceMotels.index') !!}">--}}
    {{--<i class="fa fa-edit"></i>--}}
    {{--<span  class="title">@lang("messages.home")</span></a>--}}
{{--</li>--}}

{{--<li class="{!! Request::is('motelSaves*') ? 'active' : '' !!}">--}}
    {{--<a class="nav-link nav-toggle" href="{!! route('admin.motelSaves.index') !!}">--}}
    {{--<i class="fa fa-edit"></i>--}}
    {{--<span  class="title">MotelSaves</span></a>--}}
{{--</li>--}}

{{--<li class="{!! Request::is('categoryPosts*') ? 'active' : '' !!}">--}}
    {{--<a class="nav-link nav-toggle" href="{!! route('admin.categoryPosts.index') !!}">--}}
    {{--<i class="fa fa-edit"></i>--}}
    {{--<span  class="title">CategoryPosts</span></a>--}}
{{--</li>--}}


{{--
<li class="{!! Request::is('userGroups*') ? 'active' : '' !!}">
    <a class="nav-link nav-toggle" href="{!! route('admin.userGroups.index') !!}">
    <i class="fa fa-edit"></i>
    <span  class="title">UserGroups</span></a>
</li>--}}

{{--<li class="{!! Request::is('menus*') ? 'active' : '' !!}">--}}
{{--<a class="nav-link nav-toggle" href="{!! route('admin.menus.index') !!}">--}}
{{--<i class="fa fa-edit"></i>--}}
{{--<span  class="title">Menus</span></a>--}}
{{--</li>--}}

{{--<li class="{!! Request::is('userMenus*') ? 'active' : '' !!}">--}}
{{--<a class="nav-link nav-toggle" href="{!! route('admin.userMenus.index') !!}">--}}
{{--<i class="fa fa-edit"></i>--}}
{{--<span  class="title">UserMenus</span></a>--}}
{{--</li>--}}

{{--<li class="{!! Request::is('groupMenus*') ? 'active' : '' !!}">--}}
{{--<a class="nav-link nav-toggle" href="{!! route('admin.groupMenus.index') !!}">--}}
{{--<i class="fa fa-edit"></i>--}}
{{--<span  class="title">GroupMenus</span></a>--}}
{{--</li>--}}


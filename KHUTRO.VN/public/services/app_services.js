$(document).ready(function () {
    jQuery.ajaxSetup({
        headers: { 'X-CSRF-Token' : jQuery('meta[name=_token]').attr('content') }
    });

    CKEDITOR.replaceClass = 'ckeditor';



    $('.active_checkbox').on('switchChange.bootstrapSwitch', function (event, state) {
        var checkbox_id = $(this).val();
        console.log('url:', 'admin/actions/' + checkbox_id + '/updateAjax');
        $.ajax({
            url: '/api/admin/actions/' + checkbox_id + '/updateActiveAttribute',
            type: 'PATCH',
            data: {
                id: checkbox_id
            },
            success: function (response) {
                console.log('Request success', response);
            },
            error: function (response) {
                console.log('Request error', response);
            }
        });
    });

    $('.check-all-row').on('ifClicked',function (event) {
        var groupId = $(this).val();
        var url;
        var checked = $(this).parent('[class*="icheck"]').hasClass("checked");
        if (!checked) {
            url = '/api/admin/groups/syncGroupMenuRelation?action=GROUP_CHECK_ALL'
        } else{
            url = '/api/admin/groups/syncGroupMenuRelation?action=GROUP_UNCHECK_ALL'
        }

        startAjaxLoading();

        $.ajax({

            url: url,
            type: 'POST',
            data: {
                group_id: groupId,
            },
            success: function(response)
            {
                endAjaxLoading();
                console.log('Check all success',response);
            },
            error: function (response) {
                endAjaxLoading();
                console.log('Request error',response);
            }
        });

    })

    $('.check-all-col').on('ifClicked',function (event) {
        var tableId = $(this).val().split('-')[0];
        var actionId = $(this).val().split('-')[1];
        var url;
        var checked = $(this).parent('[class*="icheck"]').hasClass("checked");
        if (!checked) {
            url = '/api/admin/groups/syncGroupMenuRelation?action=ACTION_CHECK_ALL'
        } else{
            url = '/api/admin/groups/syncGroupMenuRelation?action=ACTION_UNCHECK_ALL'
        }

        startAjaxLoading();

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                action_id: actionId,
                table_id: tableId,
            },
            success: function(response)
            {
                endAjaxLoading();
                console.log('Check all success',response);
            },
            error: function (response) {
                endAjaxLoading();
                console.log('Request error',response);
            }
        });
    })

    $('.check-all-table').on('ifClicked',function (event) {
        var tableId = $(this).val();
        var url;
        var checked = $(this).parent('[class*="icheck"]').hasClass("checked");
        if (!checked) {
            url = '/api/admin/groups/syncGroupMenuRelation?action=TABLE_CHECK_ALL'
        } else{
            url = '/api/admin/groups/syncGroupMenuRelation?action=TABLE_UNCHECK_ALL'
        }

        startAjaxLoading();

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                table_id: tableId,
            },
            success: function(response)
            {
                endAjaxLoading();
                console.log('Check all success',response);
            },
            error: function (response) {
                endAjaxLoading();
                console.log('Request error',response);
            }
        });
    })

    $('.group_menu_checkbox').on('ifClicked',function (event) {
        var groupId = $(this).val().split('-')[0];
        var tableId = $(this).val().split('-')[1];
        var actionId = $(this).val().split('-')[2];
        var url;
        var checked = $(this).parent('[class*="icheck"]').hasClass("checked");

        if (!checked) {
            url = '/api/admin/groups/syncGroupMenuRelation?action=ADD_SINGLE'
        } else{
            url = '/api/admin/groups/syncGroupMenuRelation?action=REMOVE_SINGLE'
        }

        startAjaxLoading();

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                group_id: groupId,
                table_id: tableId,
                action_id: actionId
            },
            success: function(response)
            {
                endAjaxLoading();
                console.log('Request success',response);
            },
            error: function (response) {
                endAjaxLoading();
                console.log('Request error',response);
            }
        });
    })


    /********User_menu*********/
    ajaxInUserMenu();
    /**********User*********/
    jsInUser();
    /**********Post*********/
    jsInPost();
    /**********Comment*********/
    jsInComment();
    /**********Motel*********/
    jsInMotel();
});

function jsInMotel() {
    checkboxMotelCategory();
    initFieldPriceInCreate();
    configPrice();
    init_district_town_street($('.selectBoxProvince').val());
    selectProvince();
    selectDistrict();
    selectTown();
    configMotelCategoyHtml();
    activeMotel();
}

function activeMotel() {
    action('active_motel','/api/admin/motels/');
}

function configMotelCategoyHtml() {
    var configHTML = $('#configHtml');
    var checkboxOnlySelectOne = configHTML.attr('checkboxOnlySelectOne');
    if(checkboxOnlySelectOne){
        var classConfigs = checkboxOnlySelectOne.split('&');
        for(var i = 0; i < classConfigs.length; i++){
            onlySelectOne(classConfigs[i]);
        }
    }
}

function onlySelectOne(className) {
    var allCheckBox = $('input[type="checkbox"].'+className);
    allCheckBox.on('ifClicked', function () {
        var checked = $(this).parent('[class*="icheck"]').hasClass("checked");
        if (!checked) {
            allCheckBox.iCheck('uncheck');
            $(this).prop("checked", true);
        }
    });
}

function checkboxMotelCategory() {
    var checkboxMotelCategory = $('input[type="checkbox"].checkboxMotelCategory');
    checkboxMotelCategory.on('ifClicked', function() {
        var checked = $(this).parent('[class*="icheck"]').hasClass("checked");
        if(!checked){
            // $(checkboxMotelCategory).attr('disabled',false);
            // $(this).attr('disabled',true);
            $('#label_info_category').attr('hidden',false);
            checkboxMotelCategory.iCheck('uncheck');
            $(this).prop("checked", true);
            var categoryId = $(this).attr('value');

            /*Click thi ẩn hết đi và load các trường mới lên*/
            // Ẩn hết
            $('.configMotelCategory').attr('hidden',true);
            // Hiển thị các trường theo motelCategory
            $('#configMotelCategory'+categoryId).attr('hidden',false);

            /*Phần jax phục vụ cho load ajax các trường tương ứng của danh mục BĐS
             startAjaxLoading();
             $.ajax({
             url: '/api/admin/motels/'+categoryId+'/getFieldsConfigCategory',
             type: 'PATCH',
             data: {
             },
             success: function (response) {
             var data = response.data;
             for(var i=0; i<data.length; i++){
             console.log(data);
             $('#add').append('<label><input type="checkbox" class="icheck"> Checkbox 1 </label>');
             }
             console.log(response.data);

             endAjaxLoading();
             },
             error: function (response) {
             endAjaxLoading();
             console.log('Request error', response);
             }
             })*/
        }
        else{
            $('#label_info_category').attr('hidden',true);
            $('.configMotelCategory').attr('hidden',true);
        }
    });
}

function init_district_town_street(provinceId) {
    setDistrict(provinceId);
}

function setDistrict(provinceId) {
    $.ajax({
        url: '/api/admin/motels/'+provinceId+'/getDistrict',
        type: 'PATCH',
        data: {
        },
        success: function (response) {
            var districts = response.data;
            $('.district').remove();
            for(var i = 0; i<districts.length; i++){
                var optionDistrict='';
                // console.log($('.selectBoxDistrict').attr('district'));
                // console.log(districts[i]['id']);
                // console.log('end');

                if($('.selectBoxDistrict').attr('district')==districts[i]['id']+''){
                    optionDistrict = '<option selected="selected" value='+districts[i]['id']+' class="district">'+districts[i]['name']+'('+districts[i]['id']+')'+'</option>'
                }
                else{
                    optionDistrict = '<option value='+districts[i]['id']+' class="district">'+districts[i]['name']+'('+districts[i]['id']+')'+'</option>'
                }
                $('.selectBoxDistrict').append(optionDistrict);
            }
            setTown($('.selectBoxDistrict').val());
        },
        error: function (response) {
            console.log('Request error', response);
        }
    });
}

function setTown(districtId) {
    $.ajax({
        url: '/api/admin/motels/'+districtId+'/getTown',
        type: 'PATCH',
        data: {
        },
        success: function (response) {
            var towns = response.data;
            // console.log(towns);
            $('.town').remove();
            for(var i = 0; i<towns.length; i++){
                if($('.selectBoxTown').attr('town')==towns[i]['id']+''){
                    var optionTown = '<option selected="selected" value='+towns[i]['id']+' class="town">'+towns[i]['name']+'</option>'
                }
                else{
                    var optionTown = '<option value='+towns[i]['id']+' class="town">'+towns[i]['name']+'</option>'
                }
                $('.selectBoxTown').append(optionTown);
            }
            setStreet($('.selectBoxTown').val());
        },
        error: function (response) {
            console.log('Request error', response);
        }
    });
}

function setStreet(townId) {
    $.ajax({
        url: '/api/admin/motels/'+townId+'/getStreet',
        type: 'PATCH',
        data: {
        },
        success: function (response) {
            var streets = response.data;
            $('.street').remove();
            for(var i = 0; i<streets.length; i++){
                if($('.selectBoxStreet').attr('street')==streets[i]['id']+''){
                    var optionStreet = '<option selected="selected" value='+streets[i]['id']+' class="street">'+streets[i]['name']+'</option>'
                }
                else{
                    var optionStreet = '<option value='+streets[i]['id']+' class="street">'+streets[i]['name']+'</option>'
                }
                $('.selectBoxStreet').append(optionStreet);
            }
        },
        error: function (response) {
            console.log('Request error', response);
        }
    });
}

function selectDistrict() {
    $('.selectBoxDistrict').on('change', function() {
        setTown($(this).val());
    });
}
function selectTown() {
    $('.selectBoxTown').on('change', function() {
        setStreet($(this).val());
    });
}

function selectProvince() {
    $('.selectBoxProvince').on('change', function() {
        setDistrict($(this).val());
    });
}

function initFieldPriceInCreate() {
    var price_elements = $('.price_element');
    if(price_elements.length>=1) return;
    var confif_price = $('.config_price').val();
    if(confif_price=='1'){
        var html ='<div class="form-group col-sm-3 price_element"> <label for="min_price">Giá:</label> <input class="form-control" name="price" type="number" id="price"> </div>';
        $('.price_motel').append(html);
    }
    else if(confif_price=='2'){
        var htmlP1 ='<div class="form-group col-sm-3 price_element"> <label for="min_price">Từ:</label> <input class="form-control" name="min_price" type="number" id="min_price"> </div>';
        var htmlP2 ='<div class="form-group col-sm-3 price_element"> <label for="max_price">Đến:</label> <input class="form-control" name="max_price" type="number" id="max_price"> </div>';
        $('.price_motel').append(htmlP1);
        $('.price_motel').append(htmlP2);
    }
}

function configPrice() {
    $('.config_price').on('change', function() {
        var typePrice = $(this).val();
        $('.price_element').remove();

        if(typePrice=='1'){
            var html ='<div class="form-group col-sm-3 price_element"> <label for="min_price">Giá:</label> <input class="form-control" name="price" type="number" id="price"> </div>';
            $('.price_motel').append(html);
        }
        else if(typePrice=='2'){
            var htmlP1 ='<div class="form-group col-sm-3 price_element"> <label for="min_price">Từ:</label> <input class="form-control" name="min_price" type="number" id="min_price"> </div>';
            var htmlP2 ='<div class="form-group col-sm-3 price_element"> <label for="max_price">Đến:</label> <input class="form-control" name="max_price" type="number" id="max_price"> </div>';
            $('.price_motel').append(htmlP1);
            $('.price_motel').append(htmlP2);
        }
    })
}

function jsInUser() {
    checkBoxAll();
}
function jsInPost() {
    checkBoxInCreateEdit();
    activePost();
}

function activePost() {
    action('active_post','/api/admin/posts/');
}

function jsInComment() {
    replyInShowComment();
}

function checkBoxInCreateEdit() {
    var checkAll = $('input[type="checkbox"].check-all-tag');
    var checkboxes = $('input[type="checkbox"].check-single-tag');
    if(checkboxes.filter(':checked').length == checkboxes.length) {
        checkAll.prop('checked', true);
    } else {
        checkAll.prop('checked', false);
    }
    checkAll.iCheck('update');

    checkAll.on('ifChecked ifUnchecked', function(event) {
        if (event.type == 'ifChecked') {
            checkboxes.iCheck('check');
        } else {
            checkboxes.iCheck('uncheck');
        }
    });

    checkboxes.on('ifChanged', function(event){
        if(checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', true);
        } else {
            checkAll.prop('checked', false);
        }
        checkAll.iCheck('update');
    });
}

function ajaxInUserMenu() {
    checkHeaderWhenLoadPage();
    activeUserMenu();
    ajaxCheckBox();
    hoverUser();
}

function activeUserMenu() {
    action('active_user','/api/admin/users/');
}

function ajaxCheckBox() {
    checkBoxAllInUserMenu();
    checkBoxElementInUserMenu();
    checkBoxHeaderAjaxUserMenu('headerTable');
    checkBoxHeaderAjaxUserMenu('headerUser');
    checkBoxHeaderAjaxUserMenu('headerAction');
}

/***********Active Obj use Id. Function default is 'actives()' in API class********************/
function action(modelName,urlElement) {
    $('.'+modelName).on('switchChange.bootstrapSwitch', function (event, state) {
        var model_id = $(this).val();
        startAjaxLoading();
        $.ajax({
            url: urlElement + model_id + '/actives',
            type: 'PATCH',
            data: {
                id: model_id
            },
            success: function (response) {
                endAjaxLoading();
                console.log(response.data);
                // console.log('Request success', response);
            },
            error: function (response) {
                endAjaxLoading();
                console.log('Request error', response);
            }
        });
    });
}

function checkHeaderWhenLoadPage() {
    /*Check header All*/
    checkHeaderAll();
    /*Check header user*/
    checkHeader('headerUser');
    /*Check header Action*/
    checkHeader('headerAction');
    /*Check header Table*/
    checkHeader('headerTable');

}

function checkHeaderAll() {
    var elementsUserMenu = $('input[type="checkbox"].user_menu_checkbox');
    if(elementsUserMenu.filter(':checked').length == elementsUserMenu.length) {
        $('#checkAllUserMenu').prop('checked', true);
    } else {
        $('#checkAllUserMenu').prop('checked', false);
    }
    $('#checkAllUserMenu').iCheck('update');
}

function checkHeader(classOfHeader) {
    var headers = $('input[type="checkbox"].'+classOfHeader);
    headers.each(function () {
        var elements =  $('input[type="checkbox"].'+$(this).val());
        if(elements.filter(':checked').length == elements.length) {
            $(this).prop('checked', true);
        } else {
            $(this).prop('checked', false);
        }
        $(this).iCheck('update');
    });
}

function hoverUser() {
    $('[data-toggle="tooltip"]').tooltip();
}

function checkBoxHeaderAjaxUserMenu(header) {
    var checkHeader =  $('input[type="checkbox"].'+header);
    checkHeader.on('ifClicked', function(event) {
        // checkBoxElementInUserMenu(0);
        var classOfElement = $(this).val();
        console.log(classOfElement);
        var elms = $('input[type="checkbox"].'+classOfElement);
        var url='/api/admin/usermenu/syncUserMenuRelation';
        if(header=='headerTable'){
            action = '-TABLE';
            var tableId =$(this).val().substring(5, $(this).val().length);
            var data={tableId:tableId};
        }
        if(header=='headerAction'){
            action = '-TABLE-ACTION';
            var tableId = $(this).val().split('-')[0].substring(5,$(this).val().split('-')[0].length);
            var actionId = $(this).val().split('-')[1].substring(6,$(this).val().split('-')[1].length);
            var data={tableId:tableId,
                actionId:actionId
            };

        }
        if(header=='headerUser'){
            action = '-USER';
            var userId =$(this).val().substring(4, $(this).val().length);
            var data={userId:userId};
        }

        var checked = $(this).parent('[class*="icheck"]').hasClass("checked");
        if(!checked){
            elms.iCheck('check');
            url += '?action=ADD'+action;
        }
        else{
            elms.iCheck('uncheck');
            url += '?action=REMOVE'+action;
        }
        console.log(url);
        startAjaxLoading();
        if(header=='headerTable'){
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    table_id: tableId,
                },
                success: function(response)
                {
                    endAjaxLoading();
                    console.log('Request success',response);
                },
                error: function (response) {
                    endAjaxLoading();
                    console.log('Request error',response);
                }
            });
        }
        if(header=='headerAction'){
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    action_id: actionId,
                    table_id: tableId,
                },
                success: function(response)
                {
                    endAjaxLoading();
                    console.log('Request success',response);
                },
                error: function (response) {
                    endAjaxLoading();
                    console.log('Request error',response);
                }
            });
        }
        if(header=='headerUser'){
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    user_id: userId,
                },
                success: function(response)
                {
                    endAjaxLoading();
                    console.log('Request success',response);
                },
                error: function (response) {
                    endAjaxLoading();
                    console.log('Request error',response);
                }
            });
        }

    });
}

function checkBoxElementInUserMenu() {
    var checkElements = $('input[type="checkbox"].user_menu_checkbox');
    checkElements.on('ifClicked', function(event) {
        checkHeaderWhenLoadPage();
        //update Ajax
        var dataIndex = $(this).attr('index').split('-');
        var userId = dataIndex[0];
        var tableId = dataIndex[1];
        var actionId = dataIndex[2];
        var url='/api/admin/usermenu/syncUserMenuRelation';
        var checked = $(this).parent('[class*="icheck"]').hasClass("checked");
        if (!checked) {
            url += '?action=ADD';
        }
        else{
            url += '?action=REMOVE';
        }
        startAjaxLoading();
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                user_id: userId,
                table_id: tableId,
                action_id: actionId
            },
            success: function(response)
            {
                endAjaxLoading();
                console.log('Request success',response);
            },
            error: function (response) {
                endAjaxLoading();
                console.log('Request error',response);
            }
        });

    });
    checkElements.on('ifChanged', function(event) {
        var classChange = this.className.split(' ');
        for(var i=classChange.length-1; i >= 0;i--){
            var checkboxes = $('input[type="checkbox"].'+classChange[i]);
            var x = $( "input[ value='" + classChange[i] + "']" );
            if(classChange[i]=='icheck'){
                if(checkboxes.filter(':checked').length+1 == checkboxes.length) {
                    x.prop('checked', true);
                } else {
                    x.prop('checked', false);
                }
            }
            else{
                if(checkboxes.filter(':checked').length == checkboxes.length) {
                    x.prop('checked', true);
                } else {
                    x.prop('checked', false);
                }
            }
            x.iCheck('update');
        }
    });

}

function checkBoxAllInUserMenu(){
    $('#checkAllUserMenu').on('ifClicked',function (event) {
        var r = confirm("Are you sure !");
        if (r == true) {
            var elms = $('input[type="checkbox"].icheck');
            var checked = $(this).parent('[class*="icheck"]').hasClass("checked");
            if(!checked){
                elms.iCheck('check');
                url='/api/admin/usermenu/syncUserMenuRelation?action=ADD-ALL';
            }
            else{
                elms.iCheck('uncheck');
                url='/api/admin/usermenu/syncUserMenuRelation?action=REMOVE-ALL';
            }
            startAjaxLoading();
            $.ajax({
                url: url,
                type: 'POST',
                success: function(response)
                {
                    endAjaxLoading();
                    console.log('Request success',response);
                },
                error: function (response) {
                    endAjaxLoading();
                    console.log('Request error',response);
                }
            });
        }
    });
}

function startAjaxLoading() {
    $("#wait").css("display", "block");
    $.blockUI({ css: {
        border: 'none',
        padding: '15px',
        backgroundColor: 'none',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
        opacity: .5,
        color: '#fff'
    },
        message: '',
    });
}

function endAjaxLoading(){
    $("#wait").css("display", "none");
    $.unblockUI();
}

function delete_multi_confirm() {
    var r = confirm("Are you sure!");
    if (r == true) {
        $('#items').submit();
    }
}

function checkBoxAll() {
    var elements =  $('input[type="checkbox"].'+'check-single');
    var checkAll =  $('input[type="checkbox"].'+'check-all');
    if(elements.filter(':checked').length == elements.length) {
        if(elements.length==0){
            checkAll.prop('checked', false);
        }
        else{
            checkAll.prop('checked', true);
        }
    } else {
        checkAll.prop('checked', false);
    }
    checkAll.iCheck('update');
}

function replyInShowComment() {
    jQuery(document).on('click', '.reply', function (event) {
        // console.log('abc')
        jQuery(document).find('textarea').focus();
        var id = jQuery(this).closest('.the-comment').parent().attr('id');
        jQuery('#parent_id').val(id);
    });
}
/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(function () {

  "use strict";

  //Make the dashboard widgets sortable Using jquery UI
  $(".connectedSortable").sortable({
    placeholder: "sort-highlight",
    connectWith: ".connectedSortable",
    handle: ".box-header, .nav-tabs",
    forcePlaceholderSize: true,
    zIndex: 999999
  });
  $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");

  //jQuery UI sortable for the todo list
  $(".todo-list").sortable({
    placeholder: "sort-highlight",
    handle: ".handle",
    forcePlaceholderSize: true,
    zIndex: 999999
  });


  //SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').slimScroll({
    height: '250px'
  });

  /* Morris.js Charts */


  //Fix for charts under tabs
  $('.box ul.nav a').on('shown.bs.tab', function () {
    //area.redraw();
    //donut.redraw();
    //line.redraw();
  });

  $('.btnMultiUpload').click(function () {
        multiUpload();
    });

});

$(document).on('click', '.btnSingleUpload', function () {
    singleUpload($(this));
});
var h = screen.height;
var w = screen.width;
var left = (screen.width / 2) - ((w - 300) / 2);
var top = (screen.height / 2) - ((h - 100) / 2);

function singleUpload(obj) {
    window.KCFinder = {};
    window.KCFinder.callBack = function (url) {
        $('#' + obj.data('set')).val(url);
        $('#' + obj.data('image')).attr('src', $('#app_url').val() + url);
        window.KCFinder = null;
    };
    window.open($('#url_open_kc_finder').val(), 'kcfinder_single', 'scrollbars=1,menubar=no,width=' + (w - 300) + ',height=' + (h - 300) + ',top=' + top + ',left=' + left);
}

function multiUpload() {
    window.KCFinder = {};
    window.KCFinder.callBackMultiple = function (files) {
        var strHtml = '<div class="row">';
        for (var i = 1; i <= files.length; i++) {
            strHtml += '<div class="col-md-3"><div class="img-select img-select-new">';

            strHtml += '<img class="img-thumbnail" src="' + $('#app_url').val() + files[i - 1] + '" style="width:100%">';
            strHtml += '<div class="checkbox">';
            strHtml += '<input type="hidden" name="image_tmp_url[]" value="' + files[i - 1] + '">';

            strHtml += '<label><input type="radio" name="thumbnail_img" class="thumb" value="' + files[i - 1] + '"> &nbsp;  Ảnh đại diện </label>';
            strHtml += '<button class="btn btn-danger btn-sm remove-image" type="button" data-value="' + $('#app_url').val() + files[i] + '" data-id="" ><span class="glyphicon glyphicon-trash"></span></button></div></div></div>';

            if (i % 4 == 0) strHtml += '</div><div class="row">';
        }
        strHtml += '</div>';
        $('#div-image').prepend(strHtml);
        if ($('#div-image input.thumb:checked').length == 0) {
            $('#div-image input.thumb').eq(0).prop('checked', true);
        }
        window.KCFinder = null;
    };
    window.open($('#url_open_kc_finder').val(), 'kcfinder_multiple', 'scrollbars=1,menubar=no,width=' + (w - 300) + ',height=' + (h - 300) + ',top=' + top + ',left=' + left);
}

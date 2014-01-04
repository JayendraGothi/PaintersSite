/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Create a image slider using RoundAbout Jquery Plugin
 */
$(document).ready(function() {
    $('#gallery_slider').roundabout({
        childSelector: "img",
        minOpacity: 1,
        minScale: 1.5,
        maxScale: 2.5,
        tilt: 2,
        responsive: true,
        triggerFocusEvents: true,
        dropCallback: callBack,
        clickToFocusCallback: callBack,
        autoplay: false,
        autoplayDuration: 5000,
        autoplayPauseOnHover: true,
        bearing: 0
    });
    callBack();
});
/**
 * 
 * This function is called whenever a click or drag event is performed.
 * On an image slider on Gallery Page
 */
var callBack = function() {
    if ($('#body').hasClass('#gallery_slider')) {
        var num = $('#gallery_slider').roundabout("getChildInFocus");
        var src = $('#gallery_slider img:nth-child(' + Number(num + 1) + ')').attr("src");
        $(".magniflier").attr("src", src);
    }
}
$(document).ready(function() {
    var index = -1;
    var numberOfImage = Math.floor($('#slider-border').children().length / 2);
    $('#slider-border').children().each(function() {
        var imgWidth = $(this).width();
        var imgHeight = $(this).height();
        $(this).css("top", imgHeight * index + ((imgHeight * 2) / 100 + 2) * index);
        $(this).css("z-index", -index);
        $(this).data("index", index);
        $(this).click(function() {
            $('#slider-border').children().each(function() {
                var localHeight = $(this).height();
                var localIndex = $(this).data("index") + 1;
                if (localIndex > numberOfImage) {
                    localIndex = -numberOfImage;
                }
                $(this).animate({
                    "top": localHeight * localIndex + ((localHeight * 2) / 100 + 2) * localIndex,
                    "z-index": -localIndex
                }, 500);
                $(this).data("index", localIndex);
            });
        });
        index += 1;
    });
});
$(document).ready(function() {
    $('.form-category').submit(function(event) {
        event.preventDefault();
        var obj = $(this);
        ajax_call($(this), function(response) {
            if (response.id) {
                obj.parent().find('.form-error').html("");
                obj.parent().find('.form-error').append(response.message);
                $('#side_menu ul').append('<li><a href="' + response.id + '">' + response.name + '</a></li>');
            } else {
                obj.parent().find('.form-error').html("");
                obj.parent().find('.form-error').append(response.message);
            }
        });
    });
});

//$(document).ready(function() {
//    $('.form-category').submit(function(event) {
//        event.preventDefault();
//        var obj = $(this), // (*) references the current object/form each time
//                url = obj.attr('action'),
//                method = obj.attr('method'),
//                data = {};
//
//        obj.find('[name]').each(function(index, value) {
//            // console.log(value);
//            var obj = $(this),
//                    name = obj.attr('name'),
//                    value = obj.val();
//
//            data[name] = value;
//        });
//
//        $.ajax({
//            // see the (*)
//            url: url,
//            type: method,
//            data: data,
//            success: function(response) {
//                response = JSON.parse(response);
//                if (response.id) {
//                    obj.parent().find('.form-error').html("");
//                    obj.parent().find('.form-error').append(response.message);
//                    $('#side_menu ul').append('<li><a href="' + response.id + '">' + response.name + '</a></li>');
//                } else {
//                    obj.parent().find('.form-error').html("");
//                    obj.parent().find('.form-error').append(response.message);
//                }
//            }
//        });
//        return false; //disable refresh
//    });
//});

function ajax_call(id, fn) {
    var response;
    var obj = $(id),
            url = obj.attr('action'),
            method = obj.attr('method'),
            data = {};
    obj.find('[name]').each(function(index, value) {
        var obj = $(this), name = obj.attr('name'), value = obj.val();

        data[name] = value;
    });
    $.ajax({
        url: url,
        type: method,
        data: data,
        success: function(returndata) {
            fn(JSON.parse(returndata));
        }
    });
    return false; //disable refresh
}
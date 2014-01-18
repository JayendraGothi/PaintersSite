/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    $('.form-category').submit(function(event) {
        event.preventDefault();
        var obj = $(this);
        ajax_post_call($(this), function(response) {
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
$(document).ready(function() {
    $('#fileupload').submit(function(event) {
        event.preventDefault();
        var obj = $(this);
        ajax_file_call($(this), function(response) {
            if (response.image_data) {
                obj.parent().find('.form-error').html("");
                obj.parent().find('.form-error').append(response.message);
                $('#image-display').append(response.image_data);
            } else {
                obj.parent().find('.form-error').html("");
                obj.parent().find('.form-error').append(response.message);
            }
        });
    });
});

function ajax_post_call(id, fn) {
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
function ajax_file_call(id, fn) {
    var response;
    var obj = $(id),
            url = obj.attr('action'),
            method = obj.attr('method'),
            data = {};
    obj.find('[name]').each(function(index, value) {
        var obj = $(this), name = obj.attr('name'), value = obj.val();
        data[name] = value;
    });
    $(function() {
        'use strict';
        obj.fileupload({
            url: url,
            data: data,
            done: function(e, data) {
                alert(data);
            },
            progressall: function(e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                        );
            }
        }).prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled');
    });
    return false; //disable refresh
}
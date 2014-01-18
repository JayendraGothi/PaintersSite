/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

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

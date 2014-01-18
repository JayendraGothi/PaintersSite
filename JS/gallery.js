/* 
 * To change this template, choose Tools | Templates
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
    var num = $('#gallery_slider').roundabout("getChildInFocus");
    var src = $('#gallery_slider img:nth-child(' + Number(num + 1) + ')').attr("src");
    $(".magniflier").attr("src", src);
}
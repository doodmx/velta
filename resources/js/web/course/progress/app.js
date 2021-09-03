require('../../../../plugins/simple-flow/js/simple-flow');
$(function () {


    // all settings are optional
    var settings = {
        lineWidth: 2,
        lineSpacerWidth: 15,
        lineColour: global.colors.primary,
        canvasElm: '.canvas'
    };
    // connect objects with simple flow
    $('.object').SimpleFlow(settings);
});

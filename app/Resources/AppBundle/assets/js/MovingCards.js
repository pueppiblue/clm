$(window.document).ready(init);

function init() {
    var listElements = $('.js-list-account');
    listElements.on('click', function () {
        var element = $(this).children();
        switchCardStyle(element);
    });
    console.log(element);
}

function switchCardStyle(element) {
    if (element.hasClass('bg-secondary')) {
        element.removeClass('bg-secondary');
    } else {
        element.addClass('bg-secondary');
    }

    if (element.hasClass('z-depth-1')) {
        element.removeClass('z-depth-1');
        element.addClass('z-depth-0');
    } else {
        element.removeClass('z-depth-0');
        element.addClass('z-depth-1');
    }
}

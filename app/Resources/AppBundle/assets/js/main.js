require('./MovingCards');

// materialize-css element functions
$(document).ready(function(){
    $(".dropdown-button").dropdown();
    $(".button-collapse").sideNav({
        menuWidth: 200 // Default is 240
    });
    $('.collapsible').collapsible();
});

function dragStart(ev) {
    ev.DataTransfer.effectAllowed='move';
    ev.DataTransfer.setData("Text", ev.target.getAttribute('id'));
    ev.DataTransfer.setDragImage(ev.target, 100, 100);
    return true;
}

function dragEnter(ev) {
    ev.preventDefault();
    return true;
}

function dragOver(ev) {
    ev.preventDefault();
}


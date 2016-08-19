// materialize-css element functions
$(document).ready(function(){
    $(".dropdown-button").dropdown();
    $(".button-collapse").sideNav({
        menuWidth: 200 // Default is 240
    });
    $('select').material_select();
    $('.collapsible').collapsible();
    $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: 2
    });
});

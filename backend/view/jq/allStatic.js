$(document).ready(function () {
    $("#str_toy").click(function () {

       $("#table_toys table").attr('class', 'show');
        $("#table_clothes table").attr('class', 'unShow');
        $("#table_pen table").attr('class', 'unShow');
    });
    $("#str_pen").click(function () {

        $("#table_toys table").attr('class', 'unShow');
        $("#table_clothes table").attr('class', 'unShow');
        $("#table_pen table").attr('class', 'show');
    });
    $("#str_clothes").click(function () {

        $("#table_toys table").attr('class', 'unShow');
        $("#table_clothes table").attr('class', 'show');
        $("#table_pen table").attr('class', 'unShow');
    });

    $("#search_button_date").click(function () {
       document.cookie = "date_start=" + $("#search_date_start").val();
       document.cookie = "date_stop=" + $("#search_date_stop").val();
       location.reload();
    });

    $("#refresh_button_date").click(function () {
        document.cookie = "date_start=";
        document.cookie = "date_stop=";
        location.reload();
    });
});
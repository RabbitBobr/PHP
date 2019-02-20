$(document).ready(function () {    
    $("#group_list").change(function(){
       document.cookie = "select_id=" + $("#group_list").val();
        location.reload(); 
    });
    
    $("#is_pay").change(function(){
        document.cookie = "is_pay=" + $("#is_pay").val();
        location.reload(); 
    });
    
    $("#search_date").click(function(){
        document.cookie = "date_start=" + $("#date_start").val();
        document.cookie = "date_stop=" + $("#date_stop").val();
        document.cookie = "date_set=" + "С " + $("#date_start").val() + " По " + $("#date_stop").val();
        location.reload();
    });
    
    $("#stop_date").click(function(){
        document.cookie = "date_start=";
        document.cookie = "date_stop=";
        document.cookie = "date_set=";
        location.reload();
    });

    $("#is_free_price").click(function () {
        if ($(this).is(':checked')){
            document.cookie = "is_free_price=true";
            location.reload();
        } else {
            document.cookie = "is_free_price=false";
            location.reload();
        }
    });

    $("#search_name_submit").click(function () {
       document.cookie = "search_name=" + $("#search_name").val();
       location.reload();
    });

    $("#refresh_search_name").click(function () {
       document.cookie = "search_name=";
        $("#search_name").val("");
        location.reload();
    });
});
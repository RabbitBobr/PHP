$(document).ready(function () {
    if($.cookie('filter')==='true') {
         $('#search').css("display", "block");
    } else {
       $('#search').css("display", "none");
    }

    $('#group_list').change(function () {
        document.cookie = "select_id=" + $("#group_list").val();
        location.reload();
    });

    $('#is_filter').click(function () {
        if ($(this).is(':checked')){
            document.cookie = "filter=true";
            $('#search').css("display", "block");
            location.reload();
        } else {
            document.cookie = "filter=false";
            document.cookie = "search_string=";
            $('#search').css("display", "none");
            location.reload();
        }
    });

    $('#button_str_search').click(function () {

        document.cookie = "search_string=" + $('#str_search').val();
        location.reload();

    });

    $('#is_quantity').click(function () {
        if ($(this).is(':checked')){
            document.cookie = "is_quantity=true";
        } else {
            document.cookie = "is_quantity=false";
        }
    });

    $('#is_barcode').click(function () {
        if ($(this).is(':checked')){
            document.cookie = "is_barcode=true";
        } else {
            document.cookie = "is_barcode=false";
        }
    });

    $('#is_name').click(function () {
        if ($(this).is(':checked')){
            document.cookie = "is_name=true";
        } else {
            document.cookie = "is_name=false";
        }
    });

    $('#is_article').click(function () {
        if ($(this).is(':checked')){
            document.cookie = "is_article=true";
        } else {
            document.cookie = "is_article=false";
        }
    });

    $('#is_description').click(function () {
        if ($(this).is(':checked')){
            document.cookie = "is_description=true";
        } else {
            document.cookie = "is_description=false";
        }
    });
});
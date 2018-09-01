$(document).ready(function () {
    $('#block-menu> ul > li > a').click(function(){

        if ($(this).attr('class') != 'active'){

            $('#block-menu> ul > li > ul').slideUp(400);
            $(this).next().slideToggle(400);

            $('#block-menu> ul > li > a').removeClass('active');
            $(this).addClass('active');

        }else
        {

            $('#block-menu > ul > li > a').removeClass('active');
            $('#block-menu > ul > li > ul').slideUp(400);

        }
    });

    $('#select-costs').click(function () {
        refTableCosts();
    });
    $("#add_new_cost_button").click(function () {
        var name = $("#cost_name").val();
        var price = $("#cost_price").val();

        if(name.length == 0)
            $("#cost_name").css('border-color', 'red');
        else if(price.length == 0)
        {
            $("#cost_name").css('border-color', 'grey');
            $("#cost_price").css('border-color', 'red');
        } else {
            $("#cost_price").css('border-color', 'grey');
            $.ajax({
                url: "controllers/add_new_cost_controller.php",
                type: "POST",
                data: {
                    cost_name: name,
                    cost_price: price * 100,
                    cost_date: $("#cost_date").val()
                },
                cache: false,
                dataType: "html",
                success: function () {
                    refTableCosts();
                    $("#cost_name").val("");
                    $("#cost_price").val("");
                }
            });
        }
    });
    $("#search_cost_start_button").click(function () {
        var check_date = $("#search_date_cost").is(":checked");
        var check_name = $("#search_name_cost").is(":checked");

        if(!check_date && !check_name)
            refTableCosts();
        else {
            $.ajax({
               url: "controllers/set_table_cost_controller.php",
               type: "POST",
               data: {
                   check_date: check_date,
                   check_name: check_name,
                   cost_name: $("#searching_name_cost").val(),
                   date_start: $("#date_start").val(),
                   date_stop: $("#date_end").val()
               },
                cache: false,
                dataType: "html",
                success: function (data) {
                    $("#block-table-product").html(data);
                }
            });
        }
    });
    $("#search_cost_stop_button").click(function () {
        refTableCosts();
    });

    $('#select-purchase').click(function () {
        refTablePurchase();
    });
    $("#add_string_purchase").click(function () {

        $.ajax({
            url: "controllers/purchase_create_add_data_controller.php",
            type: "POST",
            data: {
                form_array: $("#add_data_purchase_form").serialize(),
                add_string: $("#add_count_purchase").val()
            },
            cache: false,
            dataType: "html",
            success: function (data) {
                $("#add_data_purchase_form").html(data);
            }
        })
    });

    $('#select-sale').click(function () {
        refTableSale();
    });
    $("#add_string_sale").click(function () {

        $.ajax({
            url: "controllers/sale_create_add_data_controller.php",
            type: "POST",
            data: {
                form_array: $("#add_data_sale_form").serialize(),
                add_string: $("#add_count_sale").val()
            },
            cache: false,
            dataType: "html",
            success: function (data) {
                $("#add_data_sale_form").html(data);
            }
        })
    });

    $('#select-product').click(function () {
        refTableProduct();
    });
    $('#new_product_type').change(function () {
        if($('#new_product_type').val() != "no")
        {
            $.ajax({
                url: "controllers/get_category_controller.php",
                type: "POST",
                dataType: "html",
                data: {
                    type: $('#new_product_type').val()
                },
                cache: false,
                success: function (data) {
                    $('#product_new_category').prop('disabled', false);
                    $('#product_new_category').html(data);
                }
            });
        } else {
            $('#product_new_category').prop('disabled', true);
        }
    });

});

function refTableCosts() {
    $.ajax({
        url: "controllers/select_all_costs_controller.php",
        type: "POST",
        dataType: "html",
        cache: false,
        success: function (data) {
            $("#block-table-costs").html(data);
        }
    });
}
function refTablePurchase() {
    $.ajax({
        url: "controllers/select_all_procurements_controller.php",
        type: "POST",
        dataType: "html",
        cache: false,
        success: function (data) {
            $("#block-table-purchase").html(data);
        }
    });
}
function refTableSale() {
    $.ajax({
        url: "controllers/select_sales_controller.php",
        type: "POST",
        dataType: "html",
        cache: false,
        success: function (data) {
            $("#block-table-sale").html(data);
        }
    });
}
function refTableProduct() {
    $.ajax({
        url: "controllers/select_products_controller.php",
        type: "POST",
        dataType: "html",
        cache: false,
        success: function (data) {
            $("#block-table-product").html(data);
        }
    });
}
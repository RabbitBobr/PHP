$(document).ready(function () {
    refProductNamesList();

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
    $('.purchase_product_name').change(function(){
        var selected = $('option:selected', this).attr('class');
        var optionText = $('.editable').text();

        if(selected == "editable"){
            $('.editOption').show();


            $('.editOption').keyup(function(){
                var editText = $('.editOption').val();
                $('.editable').val(editText);
                $('.editable').html(editText);
            });

        }else{
            $('.editOption').hide();
        }
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
                    $('#add_new_category_product').prop('disabled', false);
                    $('#product_new_category').html(data);
                }
            });
        } else {
            $('#product_new_category').prop('disabled', true);
            $('#add_new_category_product').prop('disabled', true);
        }
    });
    $('#add_data_product_submit').click(function () {

       var error = [];
        var name = $('#product_new_name').val();
        var vendor = $('#product_new_vendor_code').val();
        var type = $('#new_product_type').val();
        if(name.length == 0) {
            error.push('Не введено название');
            $('#product_new_name').css('border-color', 'red');
        } else {
            $('#product_new_name').css('border-color', 'grey');
        }
        if(vendor.length == 0) {
            error.push('Не введен артикул');
            $('#product_new_vendor_code').css('border-color', 'red');
        } else {
            $('#product_new_vendor_code').css('border-color', 'grey');
        }
        if(type == 'no') {
            error.push('Выберите тип и категорию товара');
            $('#new_product_type').css('border-color', 'red');
        } else {
            $('#new_product_type').css('border-color', 'grey');
        }

        if(error.length == 0)
        {
            addNewProduct(name, vendor, $('#product_new_category').val());
            $('#add_new_product_block_error').html("");
            $('#product_new_name').val("");
            $('#product_new_vendor_code').val("");
            $('#new_product_type :nth-child(1)').attr('selected', 'selected');
            refTableProduct();
            refProductNamesList();
        } else {
            var wright_text_error = "<ul>";
            $.each(error, function (index, value) {
                wright_text_error += "<li>" + value.toString() + "</li>";
            });
            wright_text_error += "</ul>";
            $('#add_new_product_block_error').html(wright_text_error);
        }

    });
    $('a#start').click( function(event){
        var type = $('#new_product_type').val();
        if (type === "clothes")
            type = "Одежда";
        else if(type === "toys")
            type = "Игрушки";
        else
            type = "Канцелярские товары";
        $('#popUp > p > label').html(type);
        event.preventDefault();
        $('#overlay').fadeIn(250,
            function(){
                $('#popUp')
                    .css('display', 'block')
                    .animate({opacity: 1, top: '55%'}, 490);
            });
    });
    $('#close, #overlay').click( function(){
        $('#popUp')
            .animate({opacity: 0, top: '35%'}, 490,
                function(){
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(220);
                }
            );
    });
    $('#add_new_category_button_product').click(function () {
        var type = $('#new_product_type').val();
        var new_category = $('#add_new_category_name_product').val();
        if (type !== 'no')
            addNewCategory(type, new_category);
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
function addNewProduct(name, vendor, type_id) {
    $.ajax({
        url: "controllers/add_new_Product.php",
        type: "POST",
        dataType: "html",
        data: {
            name: name,
            vendor_code: vendor,
            type_id: type_id
        },
        cache: false
    });
}
function addNewCategory(type, new_category) {
    $.ajax({
        url: "controllers/add_new_category_controller.php",
        type: "POST",
        dataType: "html",
        cache: false,
        data: {
            type: type,
            category: new_category
        },
        success: function () {
            $('#close, #overlay').trigger('click');
        }
    });
}

function refProductNamesList() {
    $.ajax({
        url: "controllers/set_data_list_product_names_controller.php",
        type: "POST",
        dataType: "html",
        cache: false,
        success: function (data) {
            alert(data);
            $("#set_data_list_product_names").html(data);
        }
    });
}


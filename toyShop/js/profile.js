$(document).ready(function () {
    $("#select-costs").click(function () {
        $.ajax({
            type: "POST",
            url: "controllers/select_all_costs_controller.php",
            dataType: "html",
            cache: false,
            success: function (data) {
                $("#see-table").html(data);
            }
        });
    });
    $("#select-purchase").click(function () {
        $.ajax({
            type: "POST",
            url: "controllers/select_all_procurements_controller.php",
            dataType: "html",
            cache: false,
            success: function (data) {
                $("#see-table").html(data);
            }
        });
    });

    $("#select-sale").click(function () {
        $.ajax({
            type: "POST",
            url: "controllers/select_sales_controller.php",
            dataType: "html",
            cache: false,
            success: function (data) {
                $("#see-table").html(data);
            }
        });
    });

    $("#select-product").click(function () {
        $.ajax({
            type: "POST",
            url: "controllers/select_products_controller.php",
            dataType: "html",
            cache: false,
            success: function (data) {
                $("#see-table").html(data);
            }
        });
    });

});
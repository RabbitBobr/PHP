$(document).ready(function () {


    $("#see_search_cost_button").click(function () {
        $("#block_submit_search_see").attr('class', 'unShowCost');
        $("#block_submit_search_unsee").attr('class', 'showCost');
        $("#search_block").attr('class', 'showCost');
        getTable();
    });

    $("#unsee_search_cost_button").click(function () {
        $("#block_submit_search_unsee").attr('class', 'unShowCost');
        $("#block_submit_search_see").attr('class', 'showCost');
        $("#search_block").attr('class', 'unShowCost');
    });

    $("#search_date_button").click(function () {
        getTable();
    });

    $("#one_date_search").click(function () {
       $.ajax({
           type: "POST",
           url: "../controllers/acceptsController.php",
           data: {
               date_one : $("#date_one").val()
           },
           success: function (data) {
               $("#see_one_date_sum").html(data);
           }
       })
    });

    function getTable() {
        $.ajax({
            type: "POST",
            url: "../controllers/acceptsController.php",
            data: {
                date_start : $("#date_start").val(),
                date_stop : $("#date_stop").val()
            },
            success: function (data) {
                $("#tab_stat_cost").html(data);
            }
        });
    }
});
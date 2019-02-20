$(document).ready(function () {
    $("#see_add_cost_button").click(function () {
       $("#add_new_cost").attr('class', 'showCost');
       $("#block_submit_see").attr('class', 'unShowCost');
       $("#block_submit_unsee").attr('class', 'showCost');
    });

    $("#unsee_add_cost_button").click(function () {
        $("#add_new_cost").attr('class', 'unShowCost');
        $("#block_submit_see").attr('class', 'showCost');
        $("#block_submit_unsee").attr('class', 'unShowCost');
    });

    $("#save_new_cost").click(function () {

        $.ajax({
            type: "POST",
            url: "../controllers/saveNewCost.php",
            data: {
                name : $("#new_cost_name").val(),
                date : $("#new_cost_date").val(),
                price : $("#new_cost_price").val(),
                comment : $("#new_cost_comment").val()

            },
            success: location.reload()
        })
    });

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

    function getTable() {
        $.ajax({
           type: "POST",
           url: "../controllers/getTableCostDate.php",
           data: {
               date_start : $("#date_start").val(),
               date_stop : $("#date_stop").val()
           },
            success: function (data) {
                $("#tab_stat_cost").html(data);
                //alert(data);
            }
        });
    }
});
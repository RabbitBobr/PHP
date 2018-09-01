$(document).ready(function() {



    $('.top-auth').click(function(){
        $("#block-top-auth").slideToggle();

    });

    $('#button-pass-show-hide').click(function(){
        var statuspass = $('#button-pass-show-hide').attr("class");

        if (statuspass == "pass-show")
        {
            $('#button-pass-show-hide').attr("class","pass-hide");

            var $input = $("#auth_pass");
            var change = "text";
            var rep = $("<input placeholder='РџР°СЂРѕР»СЊ' type='" + change + "' />")
                .attr("id", $input.attr("id"))
                .attr("name", $input.attr("name"))
                .attr('class', $input.attr('class'))
                .val($input.val())
                .insertBefore($input);
            $input.remove();
            $input = rep;

        }else
        {
            $('#button-pass-show-hide').attr("class","pass-show");

            var $input = $("#auth_pass");
            var change = "password";
            var rep = $("<input placeholder='РџР°СЂРѕР»СЊ' type='" + change + "' />")
                .attr("id", $input.attr("id"))
                .attr("name", $input.attr("name"))
                .attr('class', $input.attr('class'))
                .val($input.val())
                .insertBefore($input);
            $input.remove();
            $input = rep;

        }
    });

    $("#button-auth").click(function() {

        var auth_login = $("#auth_login").val();
        var auth_pass = $("#auth_pass").val();


        if (auth_login == "" || auth_login.length > 30 )
        {
            $("#auth_login").css("borderColor","#FDB6B6");
            send_login = 'no';
        }else {

            $("#auth_login").css("borderColor","#DBDBDB");
            send_login = 'yes';
        }


        if (auth_pass == "" || auth_pass.length > 15 )
        {
            $("#auth_pass").css("borderColor","#FDB6B6");
            send_pass = 'no';
        }else { $("#auth_pass").css("borderColor","#DBDBDB");
        send_pass = 'yes';
        }

        if ( send_login == 'yes' && send_pass == 'yes' )
        {
            $("#button-auth").hide();
            $(".auth-loading").show();

            $.ajax({
                type: "POST",
                url: "controllers/auth_controller.php",
                data: {
                    auth_login: auth_login,
                    auth_pass: auth_pass,

                },
                dataType: "html",
                cache: false,
                success: function(data) {
                    if (data === 'true')
                    {
                        location.reload();
                    }else
                    {
                        $("#message-auth").slideDown(400);
                        $(".auth-loading").hide();
                        $("#button-auth").show();

                    }

                }
            });
        }
    });

    $('#auth-user-info').click(
        function() {
            $("#block-user").slideToggle();
        }
    );
    $('#logout').click(function(){

        $.ajax({
            type: "POST",
            url: "controllers/logout.php",
            dataType: "html",
            cache: false,
            success: function(data) {

                if (data == 'logout')
                {
                    location.reload();

                }
            }
        });
    });

    $('#block-category > ul > li > a').click(function(){

        if ($(this).attr('class') != 'active'){

            $('#block-category > ul > li > ul').slideUp(400);
            $(this).next().slideToggle(400);

            $('#block-category > ul > li > a').removeClass('active');
            $(this).addClass('active');
            $.cookie('select_cat', $(this).attr('id'));

        }else
        {

            $('#block-category > ul > li > a').removeClass('active');
            $('#block-category > ul > li > ul').slideUp(400);
            $.cookie('select_cat', '');
        }
    });

   // if ($.cookie('select_cat') != '')
    //{
     //   $('#block-category > ul > li > #'+$.cookie('select_cat')).addClass('active').next().show();
    //}

    $('#block-category2 > ul > li > a').click(function(){

        if ($(this).attr('class') != 'active'){

            $('#block-category2 > ul > li > ul').slideUp(400);
            $(this).next().slideToggle(400);

            $('#block-category2 > ul > li > a').removeClass('active');
            $(this).addClass('active');
            $.cookie('select_cat2', $(this).attr('id'));

        }else
        {

            $('#block-category2 > ul > li > a').removeClass('active');
            $('#block-category2 > ul > li > ul').slideUp(400);
            $.cookie('select_cat2', '');
        }
    });

  //  if ($.cookie('select_cat2') != '')
   // {
     //   $('#block-category2 > ul > li > #'+$.cookie('select_cat2')).addClass('active').next().show();
    //}
});
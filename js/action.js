$(document).ready(function(){

    $("button.btn").click(function(){

         $.ajax({
                 url: 'ajax/ajax_action.php',
                 type: "POST",
                 data: {action: 'check_page',
                 furl: $('#url').val()},
                 dataType: 'json',
                 success: function(return_result){

                     $("div.title_result").html(return_result.title_page);
                     $("div.countint_result").html(return_result.count_links_int);
                     $("div.countext_result").html(return_result.count_links_ext);
                     $("div.countall_result").html(return_result.count_links_all);

                     $("div.listint_result").html(return_result.list_links_int);
                     $("div.listext_result").html(return_result.list_links_ext);

                     $("#response_result").fadeIn(300);

                 }

         });

     });

});
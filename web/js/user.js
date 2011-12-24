/** user profile **/
// user_profile_share_something.tpl 
$(document).ready (function(){
    var 
    inputPlaceHolder    = $('#entry_box_input_placeholder'),
    inputEntryBox       = $('#entry_box_textarea'),
    inputButtonPost     = $('#entry_box_post_button'),
    formEntryBox        = $('#entry_box_form'),
    
    templatePost        = $("#user_profile_post");
    
    inputPlaceHolder.focus (function () {
        inputPlaceHolder.hide ();
        inputEntryBox.show ();
        inputEntryBox.focus ();
    });
    
    inputEntryBox.blur (function () {
        if (inputEntryBox.val() == "") {
            inputEntryBox.hide();
            inputPlaceHolder.show();
        }
    });
    
    inputButtonPost.click (function() {
        if (inputEntryBox.val() != "") {
            var 
            value = inputEntryBox.val(),
            url   = formEntryBox.attr("action"),
            data  = { post : value};
            $("#entry_box_loader_indicator").show();
            $.ajax({
                url     : url + "&ajax=1",             
                data    : data,
                success : function(response) {
                    inputEntryBox.val("");
                    inputEntryBox.hide();
                    inputPlaceHolder.show();
                    var template = templatePost.html().trim().replace(/<!--|-->/g,"");
                    var view = {text: response.text, id: response.id};
                    var html = Mustache.to_html(template, view);
                    $("#user_profile_post_wrapper").prepend(html);
                    $("#"+response.id + "_post").fadeIn("fast" , function(){
                        $("#entry_box_loader_indicator").hide();    
                    });
                    $("#"+response.id + "_remove_post").click(function() {
                        $(this).fadeOut("fast",function() {
                            $("#"+response.id + "_post").remove();
                        });
                    });
                }
            });
        }   
    });
});

//user_porfile_post.tpl
$(document).ready(function(){
    $.each($(".remove_post"), function (key, value) {
        $(value).click(function(){
           // post id
           var 
           id = $(this).attr("id").replace("_remove_post", ""),
           url = $("#action_remove_post").attr("action"),
           data = {id: id};
           $.ajax({
              url       : url + "&ajax=1",
              data      : data,
              success   : function (response) {
                 var id = response.id;
                 $("#" + id + "_post").fadeOut("fast",function() {
                     $(this).remove();
                 });     
              }  
           });
        });
    });
});

$(document).ready(function(){
   var 
   read_more_posts_button = $("#read_more_posts"),
   stream_start = $('#stream_start').val(),
   stream_amount = $("#stream_amount").val(); 
   
   read_more_posts_button.click(function(){
     console.log("clicking read more post button");
     var 
        data = {
             start : stream_start,
             amount: stream_amount
        },
        url
     ;
     
     $.ajax ({
         url : url + "&ajax=1",
         data: data,
         success: function(){
             
         }
     });  
   });
});


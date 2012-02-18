/** user profile **/
// user_profile_share_something.tpl 
$(document).ready (function(){
    var 
    inputPlaceHolder    = $('#entry_box_input_placeholder'),
    inputEntryBox       = $('#entry_box_textarea'),
    inputButtonPost     = $('#entry_box_post_button'),
    formEntryBox        = $('#entry_box_form'),
    
    templatePost        = $("#user_profile_post"),
    inputFriendProfileId= $("#friend_profile_id"),
    friendProfileId     = inputFriendProfileId.val();

    
    inputPlaceHolder.focus (function () {
        inputPlaceHolder.hide ();
        inputEntryBox.show ();
        inputEntryBox.focus ();
         $(inputEntryBox).animate({
                height: "40px",
                fontSize: "14px",
         },{duration:"fast"} ); 
    });
    
    inputEntryBox.blur (function () {
        if (inputEntryBox.val() == "") {
            inputEntryBox.hide();
            inputPlaceHolder.show();
            $(inputEntryBox).animate({
                height: "17px",
                fontSize: "14px",
            },{duration:"fast"} ); 
        }
    });
    
    inputButtonPost.click (function() {
        if (inputEntryBox.val() != "") {
            var 
            value = inputEntryBox.val(),
            url   = formEntryBox.attr("action"),
            data  = { post : value};
            
            if (friendProfileId) {
                data.friend_profile_id =  friendProfileId;
            }
            
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
  //   console.log("clicking read more post button");
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

$(document).ready(function() {
    var notifications_boxes = $("#notifications_box .friend_request_box_item"),
        length = notifications_boxes.length,
        id,
        numID,
        add_friend_url,
        reject_friend_url,
        add_friend_input,
        reject_friend_input,
        friend_request_id_input,
        friendship_id;
        
    for (var i = 0; i < length; i++) {
        id = notifications_boxes[i].id;
        numID = id.replace ("friend_request_id_",""); 
        add_friend_url      = $("#add_friend_url_" + numID);
        add_friend_url      = add_friend_url.val();
        reject_friend_url   = $("#reject_friend_url_" + numID);
        reject_friend_url   = reject_friend_url.val(); 
        add_friend_input    = $("#add_friend_input_" + numID);
        reject_friend_input = $("#reject_friend_input_" + numID);
        friend_request_id_input = $("#friend_request_id_input_" + numID);
        friendship_id = friend_request_id_input.val();
        
        add_friend_input.click(function() {
            var 
            data = {
               hash : "xxxxxxxxxxxxx-aqui-xxxxxxxxxxxxxx",
               friend_id : numID,
               friendship_id: friendship_id
            };

            $.ajax ({
                url : add_friend_url + "&ajax=1",
                data: data,
                type: "POST",
                success: function(){
                                                       
                }
            });     
        });
        
        reject_friend_input.click(function() {
            var 
            data = {
               hash : "xxxxxxxxxxxxx-aqui-xxxxxxxxxxxxxx",
               friend_id : numID,
               friendship_id: friendship_id 
            };
           
            $.ajax ({
                url : reject_friend_url + "&ajax=1",
                data: data,
                type: "POST",
                success: function(){
                                                       
                }
            }); 
        });
    }
});

//User edit profile photo 
$(document).ready(function () {
   var 
   user_edit_photo_form = $("#user_edit_photo_form"),
   user_edit_photo_save_button = $("#user_edit_photo_save"),
   user_edit_photo_upload_input = $("#uploadImage");
   //Submit with this button
   user_edit_photo_save_button.click(function(){
        var path = user_edit_photo_upload_input.val();
        if (path.match(/\.(jpg|png)$/)) {
            user_edit_photo_form.submit();
        }    
   });
});

//Comment Focus Effect
$(document).ready(function () {
    var 
    txtComments = $(".commentArea");
    $.each(txtComments, function (key, value) {
        $(value).focus(function(){
            $(value).animate({
                height: "40px",
                fontSize: "14px",
              },{duration:"fast"} ); 
        });
        
        $(value).blur(function(){
            $(value).animate({
                height: "20px",
                fontSize: "14px",
              },{duration:"fast"} ); 
        });        
    });
});

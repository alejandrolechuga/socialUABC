/** user profile **/
// user_profile_share_something.tpl
(function(){
    var profile = {};
    SUABC.set("profile", profile);    
}());
 
(function () {
    var commentObj = {
        "deleteComment" : function (params){
            var action_removeComment = $("#action_removeComent").attr("action");
            var commentid = params.comment_id;
            var post_id  = params.post_id;
            var element = params.element;
            var data = {};
            var url = action_removeComment;
            //data.text = $(value).val();
            data.comment_id = commentid;
            data.post_id = post_id;  
            //data.type = "post";
            $.ajax({
                url       : url + "&ajax=1",
                data      : data,
                success   : function (response) {
                    $(element).remove();  
                }  
            }); 
        },
        "addComment" : function (params) {
            var action_addComment = $("#action_addComent").attr("action"),
                commentWrapper = $("#comment_wrapper"),
                user_profile_comment = $("#user_profile_comment"),
                action_addComment = $("#action_addComent").attr("action"),
                event = params.event,
                postid = params.postid,
                value = params.value,
                response = params.response,
                elementComment = params.elementComment,
                data = {},
                url = action_addComment,
                val = $(value).val();
                console.log(response);
                console.log(value);
                console.log(event);
                console.log(postid);
                console.log(val);
            //if (commentingBusy) return;
            if (event.which) {
               if (event.which == 13) {
                   if (!event.shiftKey) {
                       if (val == "") return;
                       
                       data.text = val;
                       data.item_id = postid;
                       data.type = "post";
                       //commentingBusy = true;
                
                       $.ajax({
                          url       : url + "&ajax=1",
                          data      : data,
                          success   : function (response) {
                              var commentTemplate = user_profile_comment.html().replace(/<!--|-->/g,"");
                              var name;
                              console.log("commentTemplate");
                              console.log(commentTemplate);
                              
                              if (response.user.name) {
                                   name = response.user.name + " " +  response.user.lastname;     
                              } else {
                                   name = response.user.email;
                              }
                              
                              console.log("name");
                              console.log(name); 
                              
                              var view = { 
                                  text: response.text,
                                  web_url_pic : response.user.web_url_pic,
                                  name : name,
                                  profile_url : response.user.profile_url,
                                  comment_id : response.comment_id
                              };
                              console.log("template");
                              console.log(view);
                              console.log("elementComponen");
                              console.log(elementComment);
                              
                              var html = Mustache.to_html(commentTemplate, view);
                              elementComment.append(html);
                              
                              var comment = $("#commentid_" + response.comment_id);
                              var commentitem = $("#commentitemid_" + response.comment_id);
                              
                              $(comment).click (function(){
                                   SUABC.profile.comment.deleteComment({
                                       comment_id : response.comment_id, 
                                       post_id : postid,
                                       element : commentitem
                                   });
                              });
                              
                              $(value).val("");
                              commentingBusy = false;
                          }  
                       });
                       event.preventDefault();   
                   } else {
                       //console.log(user_profile_comment);
                       //console.log
                        //value 
                        //console.log();
                        //var template = templatePost.html().trim().replace(/<!--|-->/g,"");
                        //var view = {text: "pinche texto d mierda", id: response.id};
                        //var html = Mustache.to_html(template, view);
                                           
                   }                                   
               }
           } 
        } 
    };
    
    SUABC.profile.comment = commentObj;
}());

    
    
$(document).ready (function(){
    var 
    inputPlaceHolder    = $('#entry_box_input_placeholder'),
    inputEntryBox       = $('#entry_box_textarea'),
    inputButtonPost     = $('#entry_box_post_button'),
    formEntryBox        = $('#entry_box_form'),
    
    templatePost        = $("#user_profile_post"),
    inputFriendProfileId= $("#friend_profile_id"),
    friendProfileId     = inputFriendProfileId.val();

    
    inputPlaceHolder.focus(function() {
        inputPlaceHolder.hide();
        inputEntryBox.show();
        inputEntryBox.focus();
         $(inputEntryBox).animate({
                height: "40px",
                fontSize: "14px",
         },{duration:"fast"}); 
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
                    var view = { 
                        text: response.text, 
                        id: response.id
                    };
                    var html = Mustache.to_html(template, view);
                    var comment_area;
                    $("#user_profile_post_wrapper").prepend(html);
                    comment_area = $("#" + response.id + "_commentArea");
                    
                    $("#"+response.id + "_post").fadeIn("fast" , function(){
                        $("#entry_box_loader_indicator").hide();    
                    });
                    $("#"+response.id + "_remove_post").click(function() {
                        $(this).fadeOut("fast",function() {
                            $("#"+response.id + "_post").remove();
                        });
                    });
                    //console.log(comment_area);
                    
                    comment_area.keydown(function(event){
                        SUABC.profile.comment.addComment({
                            event : event,
                            postid : response.id ,
                            response : response,
                            value : comment_area ,
                            elementComment : $("#" + response.id + "_comment_wrapper")
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
    txtComments = $(".commentArea"),
    commentWrapper = $("#comment_wrapper"),
    user_profile_comment = $("#user_profile_comment"),
    action_addComment = $("#action_addComent").attr("action"),
    commentingBusy = false;

    $.each(txtComments, function (key, value) {
        var postid = value.id.replace("_commentArea","");
        var elementComment = $("#" + postid + "_comment_wrapper");
        ///console.log(postid + "_comment_wrapper");
        //console.log(elementComment);
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
              },{duration:"fast"}); 
        });
        
        $(value).keydown(function(event){
           SUABC.profile.comment.addComment({
                event : event,
                postid : postid,
                value : value,
                elementComment : elementComment
           });  
        }); 
        
        //Comments functionality 
        var comments = elementComment.children(".comment_item");
        $.each(comments, function (key, value ) {
           var closeElement = $(value).children(".close-icon");
           closeElement.click(function(){
               SUABC.profile.comment.deleteComment({
                   comment_id : closeElement.attr("commentid"), 
                   post_id : postid,
                   element : value
               });
           });
        });
    });
});

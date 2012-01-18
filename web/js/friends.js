/**
 * 
 */
$(document).ready (function(){
    var 
    action_add_friend = $("#add_friend_action"),
    add_friend_action_link = $("#add_friend_action_link"),
    action_add_friend_url = action_add_friend.attr("action");
    add_friend_action_link.click(function() {
        $.ajax({
          url       : action_add_friend_url + "&ajax=1",
          data      : {},
          success   : function (response) {
                           
          }  
        });    
    });
});
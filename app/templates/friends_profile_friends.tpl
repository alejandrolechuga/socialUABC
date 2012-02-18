<span class="title_span">Maestros 4</span>
<div class="user_profile_friends">
    <div class="thumb_friend"></div>
    <div class="thumb_friend"></div>
    <div class="thumb_friend"></div>
    <div class="thumb_friend"></div>
</div>
<span class="title_span">Amigos 30</span>
<div id="user_profile_friends" class="user_profile_friends">
{% for friend_item in friends.friend_set %}
    <a href="{{ friend_item.user.profileURL }}">
        <div id="friend_{{ friend_item.user.id }}"  class="thumb_friend">
            <img width="34" height="34" src="{{ friend_item.user.web_url_pic }}" /> 
        </div>      
    </a>
{% endfor %}
<div class="tooltip">
   <div class="tooltip_title">Alejandro Lechuga</div> 
   <div class="thumb_friend"></div>
</div>
{% raw %}
<script type="text/javascript">
    $(document).ready (function(){
       var friends =  $("#user_profile_friends .thumb_friend");
       $.each(friends, function(index, value) { 
            $(value).tooltip({effect:"fade",position:"top", predelay:20, delay:240});
       });
    });
</script>
{% endraw %}
</div>


<div id="user_profile_post_wrapper" class="user_profile_post_wrapper">
    <input id="stream_start" type="hidden" value="{{friends.stream.start}}" />
    <input id="stream_amount" type="hidden" value="{{friends.stream.amount}}" />
    <form id="action_remove_post" action="{{ remove_post_action }}"></form>
    <form id="action_read_more_posts" action="{{ read_more_posts_action }}"></form>
    <form id="action_addComent" action="{{ add_comment }}"></form>
    <form id="action_removeComent" action="{{ remove_comment }}"></form>
    {% for post in friends.stream.items %}
    <div id="{{ post.id }}_post" class="user_profile_post">
        <div class="user_profile_post_picture">
            <a href="{{ post.posted_by.profile_url}}">
            {% if post.posted_by.web_url_pic != '' %}
                   <img src="{{ post.posted_by.web_url_pic }}" />
               {% else %}
                   <img src="http://ramon.socialuabc.com/web/img/default.png" />       
            {% endif %} 
            </a>
        </div>
        <div class="user_profile_post_content">
            {% include 'user_post_item.tpl' %}
        </div>
    </div>
    {% endfor %}
</div>
<!--CLIENT TEMPLATE-->
<div id="user_profile_post">
    {% include 'user_post_item_mustache.tpl' %}
</div>
<div id="user_profile_comment">
    {% include 'user_comment_mustache.tpl' %}    
</div>
<!-- READ MORE POSTS-->
{% if user.show_more_posts %}
 <div id="read_more_posts">
    <span>+Leer m&aacute;s posts</span>
 </div>
{% endif %}
<!-- READ MORE POSTS -->
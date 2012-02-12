<div id="user_profile_post_wrapper" class="user_profile_post_wrapper">
    <input id="stream_start" type="hidden" value="{{friends.stream.start}}" />
    <input id="stream_amount" type="hidden" value="{{friends.stream.amount}}" />
    <form id="action_remove_post" action="{{ remove_post_action }}"></form>
    <form id="action_read_more_posts" action="{{ read_more_posts_action }}"></form>
   {% for post in  friends.stream.items %}
    <div id="{{ post.id }}_post" class="user_profile_post">
        <div class="user_profile_post_picture">
            {% if post.posted_by.web_url_pic != '' %}
                   <img src="{{ post.posted_by.web_url_pic }}" />
               {% else %}
                   <img src="http://ramon.socialuabc.com/web/img/default.png" />       
            {% endif %} 
        </div>
        <div class="user_profile_post_content">
            <div class="user_profile_post_content_name">
                <div class="user_name">{{ post.posted_by.name }} {{ post.posted_by.lastname }}</div>
                <div id="{{ post.id }}_remove_post" class="remove_post">Remove</div>
            </div>      
            <div class="user_profile_post_content_comment">
                <p>{{ post.text }}</p>
                <div class="action">
                    <span class="action_option">like</span>
                    <div class="comment_area">
                        <textarea></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {% endfor %}
</div>
<!--CLIENT TEMPLATE-->
<div id="user_profile_post">{% raw %}
    <!--
        <div id="{{id}}_post" class="user_profile_post" style="display:none;">
        <div class="user_profile_post_picture">
            {% endraw %}<img src="{{user_data.web_url_pic}}" />{% raw %}
        </div>
        <div class="user_profile_post_content">
            <div class="user_profile_post_content_name">
                <div class="user_name">{% endraw %}{{ user_data.name}} {{ user_data.lastname }}{% raw %}</div>
                <div id="{{id}}_remove_post" class="remove_post">Remove</div>
            </div>      
            <div class="user_profile_post_content_comment">
                <p>{{text}}</p>
                <div class="action">
                    <span class="action_option">like</span>
                    <div class="comment_area">
                        <textarea></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    -->          
{% endraw %}</div>
<!-- READ MORE POSTS-->
{% if user.show_more_posts %}
 <div id="read_more_posts">
    <span>+Leer m&aacute;s posts</span>
 </div>
{% endif %}
<!-- READ MORE POSTS -->
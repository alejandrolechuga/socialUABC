{% raw %}
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
                <div id="{{ id }}_comment_wrapper" class="comments_wrapper">
                </div>
                <div class="action">
                    <span class="action_option">like</span>
                    <div class="comment_area">
                        <textarea id="{{ id }}_commentArea"> </textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>     
    -->        
{% endraw %}
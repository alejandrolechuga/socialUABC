<div class="comment_item">
    <div class="user_profile_post_picture">
        <a href="{{ comment.posted_by.posted_by.profile_url}}">
        {% if comment.posted_by.web_url_pic != '' %}
               <img src="{{ comment.posted_by.web_url_pic }}" />
           {% else %}
               <img src="http://ramon.socialuabc.com/web/img/default.png" />       
        {% endif %}
        </a> 
    </div>
    <div class="user_profile_comment">
        {% if comment.posted_by.name != "" or comment.posted_by.lastname != "" %}
            <a href="{{ comment.posted_by.profile_url }}">{{ comment.posted_by.name }} {{ comment.posted_by.lastname }}</a>
            {% else %}
            <a href="{{ comment.posted_by.profile_url }}">{{ comment.posted_by.email }}</a>
        {% endif %}
    </div>
    <div commentid="{{ comment.id }}" class="close-icon"></div>
    <div class="user_comment"><p>{{ comment.text }}</p></div>
    <div class="default_date">
        <span class="default_date">{{ comment.formatted_date }}</span>
    </div>
</div>
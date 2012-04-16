{% raw %}<!--
<div id="commentitemid_{{ comment_id }}" class="comment_item">
    <div class="user_profile_post_picture">
        <img src="{{ web_url_pic }}" />
    </div>
    <div class="user_profile_comment">
        <a href="{{ profile_url }}">{{ name }}</a>
    </div>
    <div id="commentid_{{ comment_id }}" commentid="{{ comment_id }}" class="close-icon"></div>
    <div class="user_comment"><p>{{ text }}</p></div>
    <div class="default_date">
        <span class="default_date">{{ formatted_date }}</span>
    </div>
</div>
-->{% endraw %}
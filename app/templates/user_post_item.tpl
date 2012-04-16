<div class="user_profile_post_content_name">
    <div class="user_name">
        {% if post.posted_by.name != "" or post.posted_by.lastname != "" %}
            <a href="{{ post.posted_by.profile_url }}">{{ post.posted_by.name }} {{ post.posted_by.lastname }}</a>
            {% else %}
            <a href="{{ post.posted_by.profile_url }}">{{ post.posted_by.email }}</a>
        {% endif %}
    </div>
    <div id="{{ post.id }}_remove_post" class="remove_post">Remove</div>
</div>      
<div class="user_profile_post_content_comment">
    <p>{{ post.text }}</p>
    <div class="default_date">
        <span class="default_date">{{ post.formatted_date }}</span>
    </div>
    <div id="{{ post.id }}_comment_wrapper" class="comments_wrapper">
        {% if post.comments %}
            {% for comment in post.comments %}
                {% include 'user_comment.tpl' %}
            {% endfor %}
        {% endif %}
    </div>
    <div class="action">
        <span class="action_option">like</span>
        <div class="comment_area">
            <textarea id="{{ post.id }}_commentArea" class="commentArea"></textarea>
        </div>
    </div>
</div>
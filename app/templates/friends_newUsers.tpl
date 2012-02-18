<!-- <bootstrap_activity> -->
<div>
    <h3 class="label_gray">Nuevos Usuarios</h3>
    {% for item in  friends.users_set %}
        <div class="bootstrap_user_thumbnail">
            <div class="thumbnail">
                {% if item.web_url_pic != "" %}
                    <a href="{{ item.profile_url }}">
                        <img width="64" src="{{ item.web_url_pic }}" />
                    </a>
                    {% else %}
                    <a href="{{ item.profile_url }}">
                        <img width="64" src="web/img/default.png" />
                    </a>                    
                {% endif %}
            </div>
            <div class="user_thumbnail_name">
                {% if item.name != "" or  item.lastname !="" %}
                    <span><a class="label_blue" href="{{ item.profile_url }}">{{ item.name }} {{ item.lastname }}</a></span>
                    {% else %}
                    <span><a class="label_blue" href="{{ item.profile_url }}">{{ item.email }}</a></span>
                {% endif %}
            </div>
        </div>
    {% endfor %}
</div>
<!-- </bootstrap_activity> -->
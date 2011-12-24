<!-- <bootstrap_activity> -->
<div>
    <h3 class="label_gray">Nuevos Usuarios</h3>
    {% for item in  bootstrap.users_set %}
        <div class="bootstrap_user_thumbnail">
            <div class="thumbnail">
                <a href="{{ item.url }}">
                    <img width="64" src="web/img/default.png" />
                </a>
            </div>
            <div class="user_thumbnail_name">
                <span><a class="label_blue" href="{{ item.profile_url }}">{{ item.name }} {{ item.lastname }}</a></span>
            </div>
        </div>
    {% endfor %}
</div>
<!-- </bootstrap_activity> -->
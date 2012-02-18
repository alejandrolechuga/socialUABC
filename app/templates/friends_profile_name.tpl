<div class="user_profile_name">
   {% if friends.friend_data.name != "" or friends.friend_data.lastname != "" %} 
        <h4> {{ friends.friend_data.name }} {{ friends.friend_data.lastname }}</h4>
        {% else %}
        <h4> {{ friends.friend_data.email }}</h4>
   {% endif %}
</div>
<div class="user_profile_picture">
    {% if user.profile_data.web_url_pic != '' %}
           <img src="{{ user.profile_data.web_url_pic }}" />
	   {% else %}
	       <img src="http://ramon.socialuabc.com/web/img/default.png" />       
	{% endif %} 
</div>
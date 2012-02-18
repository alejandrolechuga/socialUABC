<div class="logo">
    <div {% if logged == true %}class="center_content"{% endif %}>
    	<a href="/">
    		<img src="{{img_path}}socialUABC_logo.png" alt="Logo" />
    	</a>
    	 {% if logged == true %}
    	<ul class="menu_user_profile_cuenta_right_options">    
            <li>
                <span>
                     {% if user_data.name != "" or user_data.lastname !=""  %}
                        <a href="{{ current_user_profile_url }}">{{ user_data.name }} {{ user_data.lastname }}</a>
                        {% else %}
                        <a href="{{ current_user_profile_url }}">{{ user_data.email }}</a>
                     {% endif %}
                </span>
            </li>
            <li ><span class="black_label"><a>|</a></span>
            </li>
            
            <li>
                <span id="logout_action">
                   <a href="{{ logout_action }}">logout</a>
                </span>
            </li>
        </ul>
        {% endif %}
	</div>

</div>
{% if logged == true %}
    {% include 'user_profile_cuenta.tpl' %}
{% endif%}

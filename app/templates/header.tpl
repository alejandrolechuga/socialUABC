<div class="logo">
    <div {% if logged == true %}class="center_content"{% endif %}>
    	<a href="/">
    		<img src="{{img_path}}socialUABC_logo.png" alt="Logo Here" />
    	</a>
	</div>
</div>
{% if logged == true %}
    {% include 'user_profile_cuenta.tpl' %}
{% endif%}

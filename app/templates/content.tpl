{% if logged == false %}
        {% if show_reset_password != true %}
		      {% include 'singup.tpl' %}
		  {% else %}
		      {% include 'reset_password.tpl' %}
		{% endif %}
	{% else %}
	    
		<div class="left_column">
			{% for box in content_array['left'] %}
				{% include box %}
			{% endfor %}
		</div>    
		<div class="middle_column">
			{% for box in content_array['middle'] %}
				{% include box %}
			{% endfor %}
		</div>
		<div class="right_column">
			{% for box in content_array['right'] %}
				{% include box %}
			{% endfor %}
		</div>
{% endif %}
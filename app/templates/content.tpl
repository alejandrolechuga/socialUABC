{% if logged == false %}
		{% include 'singup.tpl' %}
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
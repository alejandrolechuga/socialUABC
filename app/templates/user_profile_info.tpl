<div class="user_profile_info">
    {% if user.profile_data.location.live_city %}
	<div>
		<span class="label">Ubicacion:</span> <br />
		<span>{{ user.profile_data.location.live_city }}</span>
	</div>
	{% endif %}
	{% if user.profile_data.ocupation %}
	<div>
		<span class="label">Ocupacion:</span><br />
		<span>{{ user.profile_data.ocupation }}</span>
	</div>
	{% endif %}
	{% if user.profile_data.education %}
	<div>
		<span class="label">Educacion:</span><br />
		<span>{{ user.profile_data.education }}</span>
	</div>
	{% endif %}
	{% if user.profile_data.networks %}
	<div>
		<span class="label">Mis redes:</span><br />
		<div>
		    {% if user.profile_data.networks.facebook %}
			<a href="{{ user.profile_data.networks.facebook }}" target="_blank"><img src="web/img/socialicons/Facebook.png" /></a>
			{% endif %}
			{% if user.profile_data.networks.twitter %}
			<a href="{{ user.profile_data.networks.twitter }}" target="_blank"><img src="web/img/socialicons/Twitter.png" /></a>
			{% endif %}
			{% if user.profile_data.networks.gplus %}
			<a href="{{ user.profile_data.networks.gplus }}" target="_blank"><img src="web/img/socialicons/GooglePlus.png" /></a>
			{% endif %}
			{% if user.profile_data.networks.flickr %}
			<a href="{{ user.profile_data.networks.flickr }}" target="_blank"><img src="web/img/socialicons/Flickr.png" /></a>
			{% endif %}
			{% if user.profile_data.networks.lnikedin %}
			<a href="{{ user.profile_data.networks.lnikedin }}" target="_blank"><img src="web/img/socialicons/LinkedIn.png" /></a>
			{% endif %}
			{% if user.profile_data.networks.scribd %}
			<a href="{{ user.profile_data.networks.scribd }}" target="_blank"><img src="web/img/socialicons/Scribe.png" /></a>
			{% endif %}
			{% if user.profile_data.networks.deviantart %}
			<a href="{{ user.profile_data.networks.deviantart }}" target="_blank"><img src="web/img/socialicons/DeviantArt.png" /></a>
			{% endif %}
			{% if user.profile_data.networks.tumblr %}
			<a href="{{ user.profile_data.networks.tumblr }}" target="_blank"><img src="web/img/socialicons/Tumbler.png" /></a>
			{% endif %}
			{% if user.profile_data.networks.youtube %}
			<a href="{{ user.profile_data.networks.youtube }}" target="_blank"><img src="web/img/socialicons/YouTube.png" /></a>
			{% endif %}
		</div>
	</div>
	{% endif %}
</div>
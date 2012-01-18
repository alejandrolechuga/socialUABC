<!DOCTYPE html>
<html lang="{{ LANGUAGE }}">
	<head>
		<!--////////////////////////
			Author	: Ramon Lechuga
			Site	: http://ramonlechuga.com/
			twitter : @ramonlechuga
			Date	: March 31, 2011 
		////////////////////////////-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>socialUABC</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		  {% for js in js_array %} 
		<script type="text/javascript" src="{{ js }}" charset="utf-8"></script>
		  {% endfor %}
		  {% for css in css_array %}
		<link rel="stylesheet" type="text/css" href="{{ css }}" />
		  {% endfor %}
		<!-- Analytics Code here -->
			<script type="text/javascript">
				var _gaq = _gaq || [];
			  _gaq.push(['_setAccount', 'UA-9025491-4']);
			  _gaq.push(['_trackPageview']);
			
			  (function() {
			    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			  })();
			</script>
		<!-- Analytics Code here -->
	</head>
	<body lang="{{ LANGUAGE }}">
		<div class="wrapper">
		    {% if top_message %}
               {% include 'top_message.tpl' %}
            {% endif %}
			<div class="header">
				{% include 'header.tpl' %}
			</div>
			<div class="content {% if logged == true %}center_content{% endif %}" >
					{% include 'content.tpl' %}
			</div>
			<div class="footer">
				{% include 'footer.tpl' %}
			</div>
		</div>
        <!-- bottom scripts -->
        {% for js_bottom in js_bottom_array %} 
        <script type="text/javascript" language="JavaScript" src="{{ js_bottom }}" charset="utf-8"></script>
        {% endfor %}
        <!-- bottom scripts -->
	</body>
</html>

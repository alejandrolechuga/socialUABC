<div class="logo">
	<a href="/">
		<img src="{{img_path}}socialUABC.jpg" alt="Logo Here" />
	</a>
	<div class="user_info">
		<div class="login_wrapper">
			<form method="post" action="{{ login_action }}">
				<input id="login_email" name="email" class="text_login_input" type="text" value="email" />
				<input id="login_password" name="password" class="text_login_input" type="text" value="password" />
				<input class="submit_login" type="submit" value="go" />
				<script type="text/javascript" asyn="true">
					YUI().use('node-base', function(Y) {
						var INPUT_EMAIL_DEFAULT 		= "email",
							INPUT_PASSWORD_DEFAULT 		= "password",
							INPUT_EMAIL 				= Y.one('#login_email'),
							INPUT_PASSWORD 				= Y.one('#login_password');
							
						Y.on("click", function(){
							INPUT_EMAIL.addClass("input_login_selected");
							var value = INPUT_EMAIL.get("value");
							
							if (value == INPUT_EMAIL_DEFAULT) {
								INPUT_EMAIL.set("value","");
							}
							
						}, "#login_email");
						
						Y.on("click", function(){
							INPUT_PASSWORD.addClass("input_login_selected");
							var value = INPUT_PASSWORD.get("value");
							if (value == INPUT_PASSWORD_DEFAULT ) {
								INPUT_PASSWORD.set("value", "");
							} 
							INPUT_PASSWORD.setAttribute("type","password");
							
						}, "#login_password");
						
						Y.on("blur", function(){
							INPUT_EMAIL.removeClass("input_login_selected");
							var value =  INPUT_EMAIL.get("value");
							if (value =="") {
								INPUT_EMAIL.set("value",INPUT_EMAIL_DEFAULT);
								INPUT_EMAIL.setAttribute("type","text");
							}
						}, "#login_email");
						
						Y.on("blur", function(){
							INPUT_PASSWORD.removeClass("input_login_selected");
							var value = INPUT_PASSWORD.get("value");
							if (value == "" ) {
								INPUT_PASSWORD.set("value",INPUT_PASSWORD_DEFAULT);
								INPUT_PASSWORD.setAttribute("type","text");
							}
						}, "#login_password");
					});
				</script>
			</form>
		</div>
	</div>
</div>
<div class="menu_bar">
	<ul>
	{% for item in main_menu %}
		<li><a> {{item}} </a></li>
	{% endfor %}
	</ul>
</div>
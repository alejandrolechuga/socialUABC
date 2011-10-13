<div class="singup_container">
	<div id="upper_space" class="upper_space">
		<div class="singUp_registerbox">
			<div class="registerbox_title">
				<h2 id="register_button" class="label_white">Registrate</h2>
			</div>
			<form id="register_form" name="register_form" method="POST" action="{{ register_action }}" >
				<div id="register_form_wrapper" class="register_form_wrapper" style="height:0px;">
					<div class="singUp_row">
						<div class="singUp_label_wrapper singUp_register_ajust">
							<label class="label_white">Correo</label>
						</div>
						<div class="singUp_input_wrapper ">
							<input id="register_form_email" class="singUp_input" name="email" type="text" />
						</div>
					</div>
					<div class="singUp_row">
						<div class="singUp_label_wrapper singUp_register_ajust">
							<label class="label_white">Tu correo de nuevo</label>
						</div>
						<div class="singUp_input_wrapper">
							<input id="register_form_confirm_email" class="singUp_input" type="text" name="email_confirmation" />
						</div>
					</div>
					<div class="singUp_row">
						<div class="singUp_label_wrapper singUp_register_ajust">
							<label class="label_white">Contrase&ntilde;a</label>
						</div>
						<div class="singUp_input_wrapper"> 
							<input id="register_form_password" class="singUp_input" name="password" type="password" />
						</div>
					</div>
					<div class="singUp_row">
						<div class="singUp_label_wrapper singUp_register_ajust">
						</div>
						<div class="singUp_input_wrapper">
							<div class="gray_button">
								<input type="submit" value="Reg&iacute;strarme"/>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<script type="text/javascript">
			(function(){
				var toggle = false;
				$("#register_button").click(function (){
					if (toggle) {
						toggle = false; 
						$("#register_form_wrapper").animate({
							height: "0px"
						},500);					
					} else {
						toggle = true;
						$("#register_form_wrapper").animate({
							height: "200px"
						},500);
					}
				});
			})();
			(function(){
				//Validation
				var email_input = $("#register_form_email")[0];
				var confirm_email_input = $("#register_form_confirm_email")[0];
				var password_input = $("#register_form_password")[0];
				
				$('#register_form').submit(function() {
  					if (!SUABC.regExpLib['email'].test(email_input.value)) {
  						console.log("Email es invalido");
  						return false
  					}
  					
  					if (!SUABC.regExpLib['email'].test(email_input.value)) {
  						console.log("Confirmacion email es invalida");
  						return false;
  					}
  					
  					if (email_input.value != confirm_email_input.value) {
  						console.log("Las direcciones email no corresponden");
  						return false;
  					}
  					if (password_input.value.length < 6) {
  						console.log("El password es menor de 6 caracteres");
  						return false;
  					}
  					
  					return true;
				});
			})();
		</script>
	</div>
	<div class="singUp_bar">
		<div class="singup_socialbox">
			<div id="singUp_profile_pics" class="singUp_profile_pics">
				<div class="singup_profile_pic_column">
					<div class="singup_profile_pic"></div>
					<div class="singup_profile_pic"></div>
				</div>
				<div class="singup_profile_pic_column down_column">
					<div class="singup_profile_pic"></div>
					<div class="singup_profile_pic"></div>
				</div>
				<div class="singup_profile_pic_column">
					<div class="singup_profile_pic"></div>
					<div class="singup_profile_pic"></div>
				</div>
				<div class="singup_profile_pic_column up_column">
					<div class="singup_profile_pic"></div>
					<div class="singup_profile_pic"></div>
				</div>
				<div class="singup_profile_pic_column">
					<div class="singup_profile_pic"></div>
					<div class="singup_profile_pic"></div>
				</div>
				<div class="singup_profile_pic_column down_column">
					<div class="singup_profile_pic"></div>
					<div class="singup_profile_pic"></div>
				</div>
				<div class="singup_profile_pic_column">
					<div class="singup_profile_pic"></div>
					<div class="singup_profile_pic"></div>
				</div>
				<div class="singup_profile_pic_column up_column">
					<div class="singup_profile_pic"></div>
					<div class="singup_profile_pic"></div>
				</div>
				<div class="singup_profile_pic_column">
					<div class="singup_profile_pic"></div>
					<div class="singup_profile_pic"></div>
				</div>
				<div class="singup_profile_pic_column down_column">
					<div class="singup_profile_pic"></div>
					<div class="singup_profile_pic"></div>
				</div>
			</div>
			<script type="text/javascript">
				(function(){
					var 
					elements = $("#singUp_profile_pics .singup_profile_pic"),
					length = elements.length; 
				
					for(var i = 0 ; i < length ; i++) {
						//console.log(elements[i]);
						$(elements[i]).mouseover(function() {
							$(this).effect("bounce", { times:1 }, 200);						
						});
					}
				})();
			</script>
		</div>
		<div class="singUp_loginbox">
			<div>
				<h2 class="label_blue">Ingresa!</h2>
			</div>
			<div class="singUp_row">
				<div class="singUp_label_wrapper">
				</div>	
				<div class="singUp_input_wrapper">
					<img src="web/img/facebookLogin.png" />
				</div>
			</div>
			<form method="post" action="{{ login_action }}">
				<div class="singUp_row">
					<div class="singUp_label_wrapper">
						<label class="label_blue">Correo</label>
					</div>
					<div class="singUp_input_wrapper">
						<input id="login_form_email" name="email" class="singUp_input" type="text" />
					</div>
				</div>
				<div class="singUp_row">
					<div class="singUp_label_wrapper">
						<label class="label_blue">Contrase&ntilde;a</label>
					</div>
					<div class="singUp_input_wrapper"> 
						<input id="login_form_password" name="password" class="singUp_input" type="password" />
					</div>
				</div>
				<div class="singUp_row">
					<input type="checkbox" /> <label class="label_blue">Recordarme</label>
					<div class="gray_button">
						<input type="submit" value="Entrar"/>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="lower_space">
		<div class="singUp_forgotten">
			<div id="forgotten_form_wrapper" class="forgotten_form_wrapper" style="height:0px;">
				<div class="singUp_row">
					<div class="singUp_label_wrapper singUp_register_ajust">
						<label class="label_blue">Correo</label>
					</div>
					<div class="singUp_input_wrapper">
						<input class="singUp_input" type="text" />
					</div>
				</div>
				<div class="singUp_row">
					<div class="singUp_label_wrapper singUp_register_ajust">
					</div>
					<div class="singUp_input_wrapper">
						<div class="gray_button">
							<input type="submit" value="Recupar"/>
						</div>
					</div>
				</div>
			</div>
			<div class="forgotten_title">
				<h2 id="forgotten_password_button" class="label_white">Olvidaste tu contrase&ntilde;a?</h2>
			</div>
			<script type="text/javascript">
				(function(){
					var toggle = false;
					$("#forgotten_password_button").click(function (){
						if (toggle) {
							toggle = false; 
							$("#forgotten_form_wrapper").animate({
								height: "0px"
							},500);			
						} else {
							toggle = true;
							$("#forgotten_form_wrapper").animate({
								height: "80px"
							},500);
						}
					});
				})();
			</script>
		</div>
	</div>
</div>
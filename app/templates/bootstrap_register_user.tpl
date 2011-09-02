<div class="gBox border_box1">
	<div class="box_header"><h5>Registro</h5></div>
	<div class="gBox_body form">
		<form id="register_form" name="register_form" method="POST" action="{{ register_action }}" >
			<div class="form_row">
				<label for="email">Email:</label>
				<input id="register_form_email" type="text" name="email" />
			</div>
			<div class="form_row">
				<label for="password">Contrase&ntilde;a:</label>
				<input	id="register_form_password" type="password" name="password" />
			</div>
			<div class="form_row">
				<label for="password">Confirmar:</label>
				<input	id="register_form_password_confirm" type="password" name="password_confirmation" />
			</div>
			<div class="form_row">
				<label></label>
				<input id="register_form_submit" type="submit" value="submit" class="submit_button" />
			</div>
			<script type="text/javascript" language="JavaScript">
				/***
				 * @programmer: Alejandro Lechuga
				 * 
				 * 
				 */
				(function () {
					var REGISTER_FORM,
						SUBMIT_FORM,
						EMAIL_INPUT_FORM,
						PASSWORD_INPUT_FORM,
						PASSWORD_CONFIRM_FORM,
						complete,
						Request,
						
					complete = function(id, o, args){
						//alert(1);	
					},
			
					Request = function() {
						YUI().use('io-form', function(Y) {
							var uri = REGISTER_FORM.get('action');
							var config = {
								action: "/",
								method: "POST",
								form: {
									id: "register_form",
									useDisabled: true
								},
								data: "ajax=ajax"
							};
							Y.on('io:complete', complete, Y);
							Request = Y;
							var request = Y.io(uri,config);
						});
					};	
					
					
					YUI().use('node', function(Y) {
						REGISTER_FORM = Y.one("#register_form");
						SUBMIT_FORM = Y.one("#register_form_submit");
						EMAIL_INPUT_FORM = Y.one("#register_form_email");
						PASSWORD_INPUT_FORM =  Y.one("#register_form_password");
						PASSWORD_CONFIRMATION_FORM = Y.one("#register_form_password_confirm");

						REGISTER_FORM.on('submit',function(e){
							e.preventDefault();
						});	
						
						SUBMIT_FORM.on('click',function(){
							var 
							email_value = EMAIL_INPUT_FORM.get('value'),
							password = PASSWORD_INPUT_FORM.get('value'),
							password_confirmation = PASSWORD_CONFIRMATION_FORM.get('value');
							
							if (email_value == "") {
								//validate empty
								//validate --- email expresion 
								return false;
							}
							
							if (password == "") {
								//validate  empty
								return false;
							}
							
							if (password_confirmation != password) {
								return false;
							}
							Request();
						});
					});				
				})();
			</script>
		</form>
	</div>
</div>
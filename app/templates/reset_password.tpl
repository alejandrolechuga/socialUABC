<div class="reset_password_container">
    <div class="singUp_bar">
        <div class="signUp_reset_password">
            <br />
            <form method="post" action="{{ reset_password_action }}">
                <input type="hidden" value="{{ user.user_id }}" name="user_id" />
                <input type="hidden" value="{{ user.user_email }}" name="user_email" />
                <input type="hidden" value="{{ user.user_token }}" name="user_token" />
                <div>
                     <h2 class="label_blue">Cambia tu contrase&ntilde;a!</h2>
                </div>
                <div class="singUp_row">
                    <div class="singUp_label_wrapper">
                        <label class="label_blue">Nueva contrase&ntilde;a</label>
                    </div>
                    <div class="singUp_input_wrapper">
                        <input id="login_form_email" name="new_password" class="singUp_input" type="password" />
                    </div>
                </div>
                <div class="singUp_row">
                    <div class="singUp_label_wrapper">
                        <label class="label_blue">Repetir contrase&ntilde;a</label>
                    </div>
                    <div class="singUp_input_wrapper">
                        <input id="login_form_email" name="confirmed_password" class="singUp_input" type="password" />
                    </div>
                </div>
                <div class="singUp_row">
                    <div class="gray_button">
                        <input type="submit" value="Cambiar">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="entry_box" title="Algo nuevo ?" class="user_profile_share_something">
	<div class="share_text_field">
		<input id="entry_box_input_placeholder" type="text" value="Algo nuevo ?">
		<form id="entry_box_form" action="{{ user.entry_box_action }}" >
		  <textarea id="entry_box_textarea"></textarea>
		</form> 
	</div>
	<div>
	    <img id="entry_box_loader_indicator" src="{{img_path}}ajax-loader.gif" />
	</div>
	<div class="gray_button">
		<input id="entry_box_post_button" type="button" value="Publicar" />
	</div>
	<div class="gray_button">
		<input type="button" value="Subir Foto" />
	</div>
</div>
<div class="user_profile_cuenta">
    <div class="menu_user_profile_cuenta">
    	<ul>
    	    <li>
    	        <div class="user_profile_reference">
    	            <a href="{{ profile }}">{{ user_data.name }}</a>
    	        </div>
    	    </li>
    		<li>
    			<img src="web/img/icons/inbox-document.png" />
    			<span class="span_round">1</span>
    		</li>
    		<li class="separator"></li>
    		<li>
    			<img src="web/img/icons/information-button.png" />
    			<span class="span_round">3</span>
    		</li>
    		<li class="separator"></li>
    		<li><a href="{{ edit_info }}"><img src="web/img/icons/pencil.png" /></a></li>
    	</ul>
    	<div id="global_search">
           <input type="text" />
        </div>
    	<span id="logout_action">
    	   <a href="{{ logout_action }}">logout</a>
    	</span>
	</div>
</div>
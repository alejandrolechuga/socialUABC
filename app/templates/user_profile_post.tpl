<div id="user_profile_post_wrapper" class="user_profile_post_wrapper">
    <input id="stream_start" type="hidden" value="{{user.stream.start}}" />
    <input id="stream_amount" type="hidden" value="{{user.stream.amount}}" />
    <form id="action_remove_post" action="{{ remove_post_action }}"></form>
    <form id="action_read_more_posts" action="{{ read_more_posts_action }}"></form>
    {% for post in  user.stream.items %}
	<div id="{{ post.id }}_post" class="user_profile_post">
		<div class="user_profile_post_picture">
			<img src="https://lh6.googleusercontent.com/-RPafdNx25y8/AAAAAAAAAAI/AAAAAAAAADM/L2Ukm76YTa0/photo.jpg?sz=200" />
		</div>
		<div class="user_profile_post_content">
			<div class="user_profile_post_content_name">
				<div class="user_name">{{ user_data.name }}</div>
				<div id="{{ post.id }}_remove_post" class="remove_post">Remove</div>
			</div>		
			<div class="user_profile_post_content_comment">
				<p>{{ post.text }}</p>
				<div class="action">
					<span class="action_option">like</span>
					<div class="comment_area">
						<textarea></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
	{% endfor %}
</div>
<!--CLIENT TEMPLATE-->
<textarea id="user_profile_post">{% raw %}
    <!--<div id="{{id}}_post" class="user_profile_post" style="display:none;">
        <div class="user_profile_post_picture">
            <img src="https://lh6.googleusercontent.com/-RPafdNx25y8/AAAAAAAAAAI/AAAAAAAAADM/L2Ukm76YTa0/photo.jpg?sz=200" />
        </div>
        <div class="user_profile_post_content">
            <div class="user_profile_post_content_name">
                <div class="user_name">{{name}}</div>
                <div id="{{id}}_remove_post" class="remove_post">Remove</div>
            </div>      
            <div class="user_profile_post_content_comment">
                <p>{{text}}</p>
                <div class="action">
                    <span class="action_option">like</span>
                    <div class="comment_area">
                        <textarea></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>-->        
{% endraw %}</textarea>
<!-- READ MORE POSTS-->
 <div id="read_more_posts">
    <span>+Leer m&aacute;s posts</span>
 </div>
<!-- READ MORE POSTS -->
	<!--
	<div class="user_profile_post">
		<div class="user_profile_post_picture">
			<img src="https://lh6.googleusercontent.com/-RPafdNx25y8/AAAAAAAAAAI/AAAAAAAAADM/L2Ukm76YTa0/photo.jpg?sz=200" />
		</div>
		<div class="user_profile_post_content">
			<div class="user_profile_post_content_name">
				<div class="user_name">Alejandro Lechuga</div>
				<div class="remove_post">Remove</div>
			</div>		
			<div class="user_profile_post_content_comment">
				<div>Hello Buddies</div>
				<div class="action">
					<span class="action_option">like</span>
					<span class="action_option">dislike</span>
					<span class="action_option">lol</span>
					<span class="action_option">comment</span>
					<div class="comment_area">
						<textarea></textarea>
					</div>
				</div>
			</div>			
		</div>
	</div>
	<div class="user_profile_post">
		<div class="user_profile_post_picture">
			<img src="https://lh6.googleusercontent.com/-RPafdNx25y8/AAAAAAAAAAI/AAAAAAAAADM/L2Ukm76YTa0/photo.jpg?sz=200" />
		</div>
		<div class="user_profile_post_content">
			<div class="user_profile_post_content_name">
				<div class="user_name">Alejandro Lechuga</div>
				<div class="remove_post">Remove</div>
			</div>		
			<div class="user_profile_post_content_comment">
				<div>What is the worst TV show or movie you just cannot bare to watch? I'm gonna go with "Jersey Shore" and Tyler Perry's "Madea" Movies, ive never watched one of either, and I completely refuse to - David</div>
				<div class="action">
					<span class="action_option">like</span>
					<span class="action_option">dislike</span>
					<span class="action_option">lol</span>
					<span class="action_option">comment</span>
					<div class="comment_area">
						<textarea></textarea>
					</div>
				</div>
			</div>					
		</div>
	</div>
	<div class="user_profile_post">
		<div class="user_profile_post_picture">
			<img src="https://lh6.googleusercontent.com/-RPafdNx25y8/AAAAAAAAAAI/AAAAAAAAADM/L2Ukm76YTa0/photo.jpg?sz=200" />
		</div>
		<div class="user_profile_post_content">
			<div class="user_profile_post_content_name">
				<div class="user_name">Alejandro Lechuga</div>
				<div class="remove_post">Remove</div>
			</div>		
			<div class="user_profile_post_content_comment">
				<div>Hello Buddies</div>
				<div class="action">
					<span class="action_option">like</span>
					<span class="action_option">dislike</span>
					<span class="action_option">lol</span>
					<span class="action_option">comment</span>
					<div class="comment_area">
						<textarea></textarea>
					</div>
				</div>
			</div>								
		</div>
	</div>-->
</div>
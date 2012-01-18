{% if friends.friendship_status == 0 %}
<div class="add_friend_middle">
    <a id="add_friend_action_link" href="javascript:void(0);">Agruegar amigo +</a>
    <form id="add_friend_action" action="{{ friends.send_friend_request_url }}" method="post"></form>
</div>
{% endif %}
{% if friends.friendship_status == 1 %}
<div class="add_friend_middle">
    Petici&oacute;n Pendiente
</div>    
{% endif %}


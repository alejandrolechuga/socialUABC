<div>
    Notifications
    <div>
        Solicitud de amigo
         <br />
         <div class="friend_request_box">
         {% for fr in user.friend_requests %}
            <div class="friend_request_box_item">
                <div>   
                {{ fr.user.name }}
                </div>
                <div class="gray_button">
                    <input type="button" value="Aceptar">
                </div>
                <div class="gray_button">
                    <input type="button" value="Rechazar">
                </div>
            </div>
         {% endfor %}
         </div> 
    </div>    
</div>
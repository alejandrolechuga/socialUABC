<div id="notifications_box">
    <h3>Notifications</h3>
    <div>
         <div class="friend_request_box">
         {% for fr in user.friend_requests %}
            {% if fr.status == 1 %}
            <div id="friend_request_id_{{ fr.user.id }}" class="friend_request_box_item">
                <input id="friend_request_id_input_{{ fr.user.id }}" type="hidden" value="{{ fr.id }}" />
                <div>   
                     {{ fr.user.name }} {{ fr.user.lastname }}
                </div>
                <input id="add_friend_url_{{ fr.user.id }}" type="hidden" value="{{ fr.user.add_friend_url }}" />
                <input id="reject_friend_url_{{ fr.user.id }}" type="hidden" value="{{ fr.user.reject_friend_url }}" />
                <div class="gray_button">
                    <input id="add_friend_input_{{ fr.user.id }}" type="button" value="Aceptar"/>
                </div>
                <div class="gray_button">
                    <input id="reject_friend_input_{{ fr.user.id }}" type="button" value="Rechazar" />
                </div>
            </div>
            {% endif %}
         {% endfor %}
         </div> 
    </div>    
</div>
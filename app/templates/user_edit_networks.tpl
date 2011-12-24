<div>
    <h3 class="label_blue"> Redes Sociales</h3>
    <form method="post" >
        <div>  
            <div class="formrow">
                <div class="formlabel">
                    <label> Facebok: </label>
                </div>
                <div class="forminput">
                    {% if user.profile_data.facebook != -1 %}
                        <input class="input_text" type="text" value="{{ user.profile_data.facebook }}" />
                        {% else %}
                        <input class="input_text" type="text" value="" />
                    {% endif %}
                </div>
            </div>
            <div class="formrow">
                <div class="formlabel">
                    <label> Twitter:</label>
                </div>
                <div class="forminput">
                    {% if user.profile_data.twitter != -1 %}
                        <input class="input_text" type="text" value="{{ user.profile_data.twitter }}" />
                        {% else %}
                        <input class="input_text" type="text" value="" />
                    {% endif %}
                </div>
            </div>
            <div class="formrow">
                <div class="formlabel">
                    <label> +Google:</label>
                </div>
                <div class="forminput">
                    {% if user.profile_data.gplus != -1 %}
                        <input class="input_text" type="text" value="{{ user.profile_data.gplus }}" />
                        {% else %}
                        <input class="input_text" type="text" value="" />
                    {% endif %}
                </div>
            </div>
            <div class="formrow">
                <div class="formlabel">
                    <label> Flickr:</label>
                </div>
                <div class="forminput">
                    {% if user.profile_data.flickr != -1 %}
                        <input class="input_text" type="text" value="{{ user.profile_data.flickr }}" />
                        {% else %}
                        <input class="input_text" type="text" value="" />                        
                    {% endif %}
                </div>
            </div>
            <div class="formrow">
                <div class="formlabel">
                    <label> Linked In:</label>
                </div>
                <div class="forminput">
                    {% if user.profile_data.linkedin != -1 %}
                        <input class="input_text" type="text" value="{{ user.profile_data.linkedin }}" />
                        {% else %}
                        <input class="input_text" type="text" value="" />                        
                    {% endif %}    
                </div>
            </div>
            <div class="formrow">
                <div class="formlabel">
                    <label> Scribd:</label>
                </div>
                <div class="forminput">
                    {% if user.profile_data.scribd != -1 %}
                        <input class="input_text" type="text" value="{{ user.profile_data.scribd}}" />
                        {% else %}
                        <input class="input_text" type="text" value="" />                        
                    {% endif %}
                </div>
            </div>
            <div class="formrow">
                <div class="formlabel">
                    <label> Tumblr:</label>
                </div>
                <div class="forminput">
                    {% if user.profile_data.tumblr != -1 %}
                        <input class="input_text" type="text" value="{{ user.profile_data.tumblr }}" />
                        {% else %}
                        <input class="input_text" type="text" value="" />                        
                    {% endif %}   
                </div>
            </div>
            <div class="formrow">
                <div class="formlabel">
                    <label> Youtube:</label>
                </div>
                <div class="forminput">
                    {% if user.profile_data.youtube != -1 %}
                        <input class="input_text" type="text" value="{{ user.profile_data.youtube }}" />
                        {% else %}
                        <input class="input_text" type="text" value="" />                        
                    {% endif %}  
                </div>
            </div>
            <div class="formrow">
                <div class="formlabel">
                </div>
                <div class="forminput">
                    <div class="gray_button">
                        <input type="button" value="Guardar" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
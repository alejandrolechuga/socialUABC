<div>
    <h3 class="label_blue"> Informacion</h3>
    <form method="post" >
        <div>  
            <div class="formrow">
                <div class="formlabel">
                    <label> Nombre: </label>
                </div>
                <div class="forminput">
                    <input class="input_text" type="text" value="{{ user.profile_data.name }}" />
                </div>
            </div>
            <div class="formrow">
                <div class="formlabel">
                    <label> Apellido:</label>
                </div>
                <div class="forminput">
                    <input class="input_text" type="text" value="{{ user.profile_data.lastname }}" />
                </div>
            </div>
            <div class="formrow">
                <div class="formlabel">
                    <label> Educacion:</label>
                </div>
                <div class="forminput">
                    <input class="input_text" type="text" value="{{ user.profile_data.education }}" />
                </div>
            </div>
            <div class="formrow">
                <div class="formlabel">
                    <label> Ocupacion:</label>
                </div>
                <div class="forminput">
                    <input class="input_text" type="text" value="{{ user.profile_data.occupation }}" />
                </div>
            </div>
            <div class="formrow">
                <div class="formlabel">
                    <label> Viviendo en:</label>
                </div>
                <div class="forminput">
                    <input class="input_text" type="text" value="{{ user.profile_data.live_city_text }}" />
                </div>
            </div>
            <div class="formrow">
                <div class="formlabel">
                    <label> Nacido en:</label>
                </div>
                <div class="forminput">
                    <input class="input_text" type="text" value="{{ user.profile_data.born_city_text}}" />
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
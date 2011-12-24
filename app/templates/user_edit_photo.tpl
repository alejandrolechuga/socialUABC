<div>
    <h3 class="label_blue"> Foto de perfil</h3>
    <form>
        <input id="uploadImage" type="file" value="Choose a pic" onchange="changei();" />
        <div id="dragdropfile">
            <h3>Arrastra y Suelta aqui una imagen</h3>
            <script type="text/javascript">
    
                    var 
                    fileReader  = new FileReader(),
                    formatFilter = /^(image\/bmp|image\/cis-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x-cmu-raster|image\/x-cmx|image\/x-icon|image\/x-portable-anymap|image\/x-portable-bitmap|image\/x-portable-graymap|image\/x-portable-pixmap|image\/x-rgb|image\/x-xbitmap|image\/x-xpixmap|image\/x-xwindowdump)$/i,
                    area = document.getElementById("dragdropfile");
                    
                    fileReader.onload = function (ev) {
                        var img = document.createElement('img');
                        img.src = ev.target.result;
                        img.width = 60;
                        area.appendChild(img);
                    };
                    function changei (){
                        if (document.getElementById("uploadImage").files.length === 0) { return; }  
                        var oFile = document.getElementById("uploadImage").files[0];  
                        if (!formatFilter.test(oFile.type)) { alert("You must select a valid image file!"); return; }  
                        fileReader.readAsDataURL(oFile);  
                    }
            </script>
        </div>
    </form>
</div>
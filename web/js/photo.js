/**;
 * @author David_0991
 */


//Photos uploadNewImg
$(document).ready(function () {
    var 
    photos_upload_photo_form = $("#photos_showGallery_uploadPhoto_form"),
    photos_upload_photo_save_button = $("#photos_save"),
    photos_upload_photo_input = $("#photos_uploadImage");
    photos_id_gallery_select = $("#select_id_gallery");
    photos_description = $("#photo_description"); 
    //Submit with this button
    photos_upload_photo_save_button.click(function(){
        var path = photos_upload_photo_input.val();
        var description= photos_description.val();
        var id_gallery = photos_id_gallery_select.val();
        //alert(photos_id_gallery_select.val());
        //alert(photos_description.val());
        if (path.match(/\.(jpg|png)$/)) {
            
            
            photos_upload_photo_form.submit();
        }    
    });
});


//edit gallery information (UPDATE)
var        
dialogContainer	= $('#DialogcontainerEditGallery'),
banDialog	= $('#user_edit_gallery_information'),    
formEntryBox    = $('#entry_box_form');
    
function showDialogEditGallery() {
    var template = dialogContainer.html().trim().replace(/<!--DIALOG_EDIT_GALLERY|-->/g,"");
    var html = Mustache.to_html(template);                    
    $(".middle_column:first").prepend(html);                                          
    $('div#user_edit_gallery_information').css('visibility','visible');
    $('div#shadow_back').css('visibility','visible');            
        
         
    
}

function editGallerySubmit() {
    var 
    input_album_name    = $('#edit_album_name'),
    input_album_description       = $('#edit_album_description'),
    formEntryBox        = $('#entry_box_form'),
    gallery_id = getURLParam("id");
    
    var 
    name = input_album_name.val(),
    description = input_album_description.val(),
    url   = formEntryBox.attr("action"),
    data  = {
        gallery_name : name,
        gallery_description : description,
        gallery_id : gallery_id
    };
    

    $.ajax({
        url     : url + "&ajax=1",             
        data    : data,
        success : function(response) {
            var template= $("#user_profile_post").html().trim().replace(/<!--TEST|-->/g,"");
            var view = {
                name_gallery : response.galery_name
                
            };
            var html = Mustache.to_html(template, view);
            $("#jaja").prepend(html);
        }
    });
         
    $('div#user_edit_gallery_information').remove();
    $('div#shadow_back').remove();		
} 

function hideDialogEditGallery() {
    $('div#user_edit_gallery_information').remove();
    $('div#shadow_back').remove();		
}
	

//Photos Create new gallery

//Obtener parametros apartir de la URL desde JS 
//Ejemplo &var=1&var2=2,etc
function getURLParam(strParamName){
    var strReturn = "";
    var strHref = window.location.href;
    if ( strHref.indexOf("&") > -1 ){
        var strStringParam = strHref.substr(strHref.indexOf("&")).toLowerCase();
        var params = strStringParam.split("&");
        for ( var posParams = 0; posParams < params.length; posParams++ ){
            if (params[posParams].indexOf(strParamName + "=") > -1 ){
                var aParam = params[posParams].split("=");
                strReturn = aParam[1];
                break;
            }
        }
    }
    return strReturn;
}


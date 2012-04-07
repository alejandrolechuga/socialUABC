<?php
    global $statuscodes;  
    $statuscodes = array();
    //USER
    $statuscodes[1000]               = array();
    $statuscodes[1000]['success']    = true;
    
    $statuscodes[1001]               = array();
    $statuscodes[1001]['success']    = false;
    $statuscodes[1001]['title']      = "Problema con registro";
    $statuscodes[1001]['message']    = "El correo que usted esta intentando registrar ya fue tomado por otro usuario.";
    
    $statuscodes[1002]               = array();
    $statuscodes[1002]['success']    = false;

    $statuscodes[1003]               = array();
    $statuscodes[1003]['title']      = "Acceso";
    $statuscodes[1003]['message']    = "El correo o password es incorrecto.";
    $statuscodes[1003]['success']    = false;
    
    $statuscodes[1004]               = array();
    $statuscodes[1004]['success']    = false;
    $statuscodes[1004]['title']      = "Problema con confirmación";
    $statuscodes[1004]['message']    = "Existe un problema con la confirmacion por correo, intente registrarse de nuevo.";
    
    $statuscodes[1005]               = array();
    $statuscodes[1005]['success']    = false;
    $statuscodes[1005]['title']      = "Cuenta no confirmada aun";
    $statuscodes[1005]['message']    = "Si usted es el dueño de este correo profavor primero confirmar su cuenta de otra manera registrarse.";
        
    $statuscodes[1006]               = array();
    $statuscodes[1006]['success']    = false;
    $statuscodes[1006]['title']      = "Acceso";
    $statuscodes[1006]['message']    = "El correo o password es incorrecto.";
    
    $statuscodes[1007]               = array();
    $statuscodes[1007]['success']    = false;
    $statuscodes[1007]['title']      = "Sesión no disponible";
    $statuscodes[1007]['message']    = "La seccion que usted intenta acceder requiere iniciar sesión, ingrese de nuevo.";
    
    $statuscodes[1008]               = array();
    $statuscodes[1008]['success']    = false;
    $statuscodes[1008]['title']      = "No se pudo agregar";
    $statuscodes[1008]['message']    = "Por alguna razon no se pudo agregar el ultimo post.";
    
    $statuscodes[1009]               = array();
    $statuscodes[1009]['success']    = false;
    $statuscodes[1009]['title']      = "No se pudo eliminar el post";
    $statuscodes[1009]['message']    = "Por alguna razon no se pudo eliminar el ultimo post.";    
    
    $statuscodes[1010]               = array();
    $statuscodes[1010]['success']    = true;
    $statuscodes[1010]['title']      = "Correo de recuperación de contraseña";
    $statuscodes[1010]['message']    = "Se le ha enviado un correo para confirmar y cambiar su contraseña";
    
    $statuscodes[1011]               = array();
    $statuscodes[1011]['success']    = true;
    $statuscodes[1011]['title']      = "Contraseña cambiada exitosamente.";
    $statuscodes[1011]['message']    = "";
    
    $statuscodes[1012]               = array();
    $statuscodes[1012]['success']    = false;
    $statuscodes[1012]['title']      = "URL No disponible";
    $statuscodes[1012]['message']    = "El link que tratas de acceder ya no se encuentra disponible";
    
    $statuscodes[1013]               = array();
    $statuscodes[1013]['success']    = false;
    $statuscodes[1013]['title']      = "La contraseña no es valida";
    $statuscodes[1013]['message']    = "La contraseña no es identico al de la confirmación o es incorrecto";
    //Friends
    
    $statuscodes[2001]               = array();
    $statuscodes[2001]['success']    = false;
    $statuscodes[2001]['title']      = "No se pudo insertar el friend request";
    $statuscodes[2001]['message']    = "Problema con base de datos o query al tratar de insertar el record para friend request.";
    
    //Comment
    $statuscodes[3001]               = array();
    $statuscodes[3001]['success']    = false;
    $statuscodes[3001]['title']      = "No se pudo agregar comentario";
    $statuscodes[3001]['message']    = "";
    
?>
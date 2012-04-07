<html>
    <head>
        <style type="text/css">
            body {
                 background-color:#EBF6FD;
            }
            div.wrapper {
                padding:18px;
                font-size:12px;
                color:black;
                background-color:#EBF6FD;
                border:5px solid #80C9F7;
                font-family:Helvetica,Verdana;
                overflow:hidden;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div>
                <img src="{{img_path}}socialUABC_logo.png" alt="Logo" />
            </div>
            <div>
                 <h3>Cambiar contrase&ntilde;a</h3>
                 <p>Para poder cambiar tu contraseña porfavor da click en el siguiente enlace 
                 <a href="{{ recovery_url }}">click aqui</a> , gracias.
                 Si tienes problemas con el link copia el siguiente enlance y pegalo en tu navegador 
                 <strong>{{ recovery_url }}</strong></p>
            </div>
        </div>
    </body>
</html>
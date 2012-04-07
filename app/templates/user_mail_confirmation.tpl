<html>
	<head>
		<style type="text/javascript">
			div.wrapper {
				padding:18px;
				font-size:12px;
				color:black;
				background-color:#EBF6FD;
				border:5px solid #80C9F7;
				font-family:Helvetica,Verdana;
			}
		</style>
	</head>
	<body>
		<div class="wrapper">
		    <div>
		      <img src="{{img_path}}socialUABC_logo.png" alt="Logo" />
		    </div>
		    <div>
    			Hey Bienvenido a socialUABC.com presiona el siguiente link para confirma tu cuenta
    			<a href="{{ confirmation_url }}">click aqui</a> , gracias.
    			Si tienes problemas con el link copia el siguiente enlance y pegalo en tu navegador 
    			<strong>{{ confirmation_url }}</strong>
			</div>
		</div>
	</body>
</html>
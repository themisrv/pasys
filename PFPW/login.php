<?php session_start() ?>

<?php require 'inc/header.inc.php';?>

<div class="container-fluid">
	<div class="row">
		<div class=" col-sm-12  col-centrar">

<?php
	if ($_POST) {
		require 'lib/config.php';
		spl_autoload_register(function($clase){
                      require_once "lib/$clase.php";
                  });
	              		
	 extract($_POST,EXTR_OVERWRITE);
	$expreg='/^[_a-z0-9-]+(\.[_a-z0-9]+)*@[a-z0-9]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
if ($email_usuario && $contraseña_usuario ) {

	$db=new database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	$validaEmail=$db->validardatos('correo_usuario','acceso',$email_usuario);
		if (preg_match($expreg,$email_usuario)) {
			if ($validaEmail!=0) {
				$db->preparar("SELECT nombre_usuario,correo_usuario,password,image FROM acceso  WHERE correo_usuario='$email_usuario'");
				$db->ejecutar();
				$db->prep()->bind_result($dbnombre,$dbcorreo,$dbcontraseña,$dbrutaSubida);
				$db->resultado();
				if ($email_usuario==$dbcorreo){
					if ($contraseña_usuario==$dbcontraseña) {
						$_SESSION['idSesion']=$dbcorreo;
						$_SESSION['nombre']=$dbnombre;
						$_SESSION['imagen']=$dbrutaSubida;

						$db->cerrar();
						header("Location: admin.php");
					}else{"<div class='alert alert-danger' role='alert'>
  <strong>ERROR! </strong>La contraseña no coinicide con el correo proporcionado <a href='#' class='alert-link'>Haz clic para recuperar contraseña.</a></div>";
								}
				}
			}else{echo "<div class='alert alert-danger' role='alert'> El correo no se encuentra registrado!</div>"; 
			header("Refresh:4;url=index.php");
		}
		}else{echo "<div class='alert alert-danger' role='alert'> El correo no cumple con el formato especificado!</div>";}
		
	}else{echo "Depurando";}
}

?>             		
		</div>
	</div>
</div>
<?php require 'inc/footer.inc.php';?>
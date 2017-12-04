<?php require 'inc/header.inc.php'; 
include 'navbar.php';
?>
<div class="container-fluid">
       <div class="row">
           <div class="col-md-12 text-center">
           </div>
       </div>
          <div class="row">
              <div class="col-sm-4 col-center box">
              	<?php  
              	require_once 'lib/config.php';
              	require 'lib/validarfoto.php';
                  
                  spl_autoload_register(function($clase){
                      require_once "lib/$clase.php";
                  });
			
              	if ($_POST) {
              		
              		extract($_POST,EXTR_OVERWRITE);
              		if (!file_exists('fotos')) {
              			mkdir("fotos",0777);
              		}
    

    $db=new database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
/*$db->preparar("SELECT nombre_usuario, numero_visitas FROM acceso");
$db->ejecutar();
$db->prep()->bind_result($nombre_usuario,$numero_visitas);
while ($db->resultado()) {
	echo $nombre_usuario." ".$numero_visitas."<br>";
}

echo $db->validardatos('correo_usuario','acceso','dflores234@gmail.com');*/
 if ($nombre_usuario && $email_usuario &&$contraseña && $repetir_contraseña) {
	$expreg='/^[_a-z0-9-]+(\.[_a-z0-9]+)*@[a-z0-9]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
 	if (preg_match($expreg, $email_usuario)) {
		if (strlen($contraseña)>=8) {
 			if ($contraseña==$repetir_contraseña) {
 			$validaEmail=$db->validardatos('correo_usuario','acceso',$email_usuario);
 						if ($validaEmail==0) {
 							$nombre_usuario2=strtolower($nombre_usuario);
 							if (validarfoto($nombre_usuario2)) {
 										//echo "<img class='img-responsive'src='$rutaSubida' alt=''>";
 								//exit();
              			if ($db->preparar("INSERT INTO acceso VALUES ('$email_usuario','$contraseña',
              				'$nombre_usuario','$rutaSubida')")) {
              				$db->ejecutar();
              				echo "<div class='alert alert-success' role='alert'>
  $nombre_usuario, Te has registrado correctamente
<img src='$rutaSubida' alt='' class='img-responsive rounded-circle'>
</div>";
header("Refresh:5;url=index.php");
$db->cerrar();
              			}
 									}else{echo "<div class='alert alert-danger'role='alert'>
  									$error</div>";}
 								}else{echo "<div class='alert alert-danger' role='alert'>
  <strong>ERROR! </strong>El correo electrónico ya se encuentra registrado <a href='#' class='alert-link'>Haz clic para recuperar contraseña.</a></div>";}
 							}else{
 echo "<div class='alert alert-danger' role='alert'>
  <strong>ERROR! </strong>Las contraseñas no coinciden</div>";
 							}
 						}else{echo "<div class='alert alert-danger' role='alert'>
  <strong>ERROR! </strong>Las contraseñas deben de ser de 8 caracteres</div>";}
 					}else{echo "<div class='alert alert-danger' role='alert'>
  <strong>ERROR! </strong>Correo electrónico erroneo, intente nuevamente</div>";}
 				}
 			}


?>
                  <form action="#" method="POST" role="form" enctype="multipart/form-data">
                  <legend><center>Registrarse</center></legend>
                  <div class="form-group">
                        <input type="text" class="form-control" id="" placeholder="Nombre completo"  name="nombre_usuario">
                    </div>
                  <div class="form-group">
                        <input type="email" class="form-control" id="" placeholder="Correo"  name="email_usuario">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="" placeholder="Contraseña"  name="contraseña">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="" placeholder="Repetir contraseña"  name="repetir_contraseña">
                    </div>
                    <div class="form-group">
                    	<label>Seleccione foto de perfil</label>
                    	
			<input type="file" name="foto" value="" placeholder="Seleccione foto de perfil">
			</div>
             <button type="submit" class="btn btn-primary" name="registrarse">Registrarse</button>    
                </form>
         
              </div>
          </div>




























<?php require 'inc/footer.inc.php'; ?>
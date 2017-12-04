<?php session_start(); $dbcorreo=$_SESSION['idSesion'];
if (!$_SESSION['idSesion']&&!$_SESSION['nombre']) { header("Location: index.php");
exit;}
 require 'inc/header.inc.php';
    if ($_POST) {
      require 'lib/config.php';
    spl_autoload_register(function($clase){
                      require_once "lib/$clase.php";
                  });
                  extract($_POST,EXTR_OVERWRITE);
                  //var_dump($_POST);
                $db=new database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
           $db->cambiarDatabase('pedidos');
           if ($db->preparar("INSERT INTO pedidos VALUES ('$dbcorreo',true,
                      4,false,60)")) {
                      $db->ejecutar();
                      echo "<div class='alert alert-success' role='alert'>Has solicitado tu pedido correctamente.</div>";
header("Refresh:5;url=admin.php");
$db->cerrar();
}
              }


 ?>




<div class="container-fluid">
	<div class="row">
		<div class="col-sm-4 box" >

			<h3>Bienvenido, <?php echo ucwords($_SESSION['nombre']); ?></h3>
			<center><img src='<?php echo $_SESSION['imagen'];?>' alt="" class="img-responsive img-thumbnail rounded-circle"></center>
			<form action="#" method="POST" role="form">
             <legend><center>Solicitar Material:</center></legend>
                 <div class="form-check form-check-inline">
  					<label class="form-check-label">
    				<input class="form-check-input" type="radio" name="rfid" value="llaveros"> Llaveros
  					</label>
				</div>
				<div class="form-check form-check-inline">
  				<label class="form-check-label">
    			<input class="form-check-input" type="radio" name="rfid"  value="tarjetas"> Tarjetas
  				</label>
				</div>
				<div class="form-group">
    			<label for="exampleFormControlSelect1">Cantidad:</label>
    			<select class="form-control" name=" cantidad">
      			<option>1</option>
				    <option>2</option>
      			<option>3</option>
      			<option>4</option>
      			<option>5</option>
    			</select>
    			</div>
          <button type="submit" class="btn btn-info pull-right">Pedir</button>
            </form>
            <a href="cambiardir.php" class="btn btn-link">Cambiar dirección de envío</a>
            <form  action="ticket.php" method="POST" role="form">
              <button type="submit" id="Ticket" class="btn btn-info pull-right" action="ticket.php" >Imprimir Ticket</button>
            </form>
          </div>
      </div>
  </div>
<?php require 'inc/footer.inc.php';?>


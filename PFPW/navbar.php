<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    	<a class="navbar-brand" href="index.php">
    		<img src="img/pasys.png" width="30" height="30" class="d-inline-block align-top" alt="">
    PASYS</a>
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          	<a class="nav-link" href="index.php">Inicio</a>
        <li class="nav-item">
          <a class="nav-link" href="acerca.php">Descripción de la compañía</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="productos.php">Productos</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" action="login.php" method="POST">
      <input class="form-control mr-sm-2 form-control-sm" type="email" placeholder="Usuario" name="email_usuario">
      <input class="form-control mr-sm-2 form-control-sm" type="password" placeholder="Contraseña" name="contraseña_usuario">
      <button class="btn btn-outline-info my-2 my-sm-0 btn-sm" type="submit">Iniciar Sesion</button>
    </form>
    <a href="registrarse.php" class="btn btn-link">Registrarse</a>
	  </nav>
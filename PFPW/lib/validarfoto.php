<?php 
function validarFoto($nombre, $update=false){

if ($update) {
    $dir="fotos/$nombre";
    $gestor=opendir($dir);
    while (false!=($archivo=readdir($gestor))) {
        if ($archivo!='.'&&$archivo!='..' && $archivo!='Thumbs.db') {
            unlink("$dir/$archivo");
        }
    }
    closedir($gestor);
    sleep(1);
}

    global $dirSubida;
    global $rutaSubida;
    global $error;
    
    $dirSubida="fotos/$nombre/";
    $foto = $_FILES['foto']; 
    $nombreFoto=$foto['name'];
    $nombreTmp=$foto['tmp_name'];
    $rutaSubida="{$dirSubida}profile.jpg";
    $extArchivo=preg_replace('/image\//','',$foto['type']);
                        
    if($extArchivo=='jpeg'||$extArchivo=='png'){
        if(!file_exists($dirSubida)){
            mkdir($dirSubida,0777);                   
        }
        if (move_uploaded_file($nombreTmp,$rutaSubida)){
//echo "<img class='img-responsive' src='$rutaSubida' alt=''>";
        return true;
            }else{
            $error="No se pudo mover el archivo";
            }
    }else{
    $error="No es un archivo de imagen válido";    
    }
 }

              




 ?>
<?php 

class database{
	public $db;
    protected $resultado;
    protected $prep;
    protected $consulta;
    
public function __construct($dbhost,$dbuser,$dbpass,$dbname){
        $this->db=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
            if($this->db->connect_errno){
                trigger_error("Falló la conexión con MYSQL, Tipo de error ->({$this->db->connect_error})", E_USER_ERROR);
            }
        $this->db->set_charset('utf8');
    }
    
    public function getUsuarios(){
    $this->resultado=$this->db->query("SELECT * FROM acceso");
    return $this->resultado->fetch_all();
    }
    
public function preparar($consulta){
    $this->consulta=$consulta;
    $this->prep=$this->db->prepare($this->consulta);
    if(!$this->prep){
        echo "<div class='alert alert-danger' role='alert'><strong>ERROR! Al preparar la consulta</strong></div>";
    }else{return true;}
}

    
    public function ejecutar(){
        $this->prep->execute();
    }
    
    public function prep(){
        return $this->prep;
    }
    
public function resultado(){
        return $this->prep->fetch();
    }

public function cambiarDatabase($db){
        $this->db->select_db($db); 
    }

public function validardatos($columna,$tabla,$condicion){
    $this->resultado=$this->db->query("SELECT $columna FROM $tabla WHERE $columna='$condicion'");
    $checar=$this->resultado->num_rows;
    return $checar;
}

public function cerrar(){
    $this->db->close();
    $this->prep->close();
}

}?>
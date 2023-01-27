<?php
require("Conexion.php");
class Form extends Conexion{
    private $comentario;
    private $nota;
    public function __construct($postComment,$postNota){
        parent::__construct();
        $this->comentario = htmlentities(addslashes($postComment));
        $this->nota = htmlentities(addslashes($postNota));
    }
    public function enviarFormulario(){
        $consulta = "INSERT INTO encuesta (nota, comentario, fecha) VALUES (:NOTA,:COMENTARIO,CURRENT_DATE)";
        $resultado=$this->db_conexion->prepare($consulta);
        $resultado->bindValue(":NOTA", $this->nota);
        $resultado->bindValue(":COMENTARIO", $this->comentario);
        if ($resultado->execute()) {
            echo "CONEXION";
        } else {
            echo "ERROR";
        }
    }

}
?>
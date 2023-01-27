<?php
require("Conexion.php");
class Form extends Conexion{
    private $profesor;
    private $lista_Profesores;
    private $comentario;
    private $nota;
    public function __construct($profesor){
        parent::__construct();
        $this->profesor= $profesor;
        /*Lista profe*/
        $consulta = "select usuario from usuarios;";
        $resultado = $this->db_conexion->query($consulta);
        $this->lista_Profesores = $resultado->fetchAll();
    }
    /*SETTER*/
    public function setComment($postComment,$postNota){
        $this->comentario = htmlentities(addslashes($postComment));
        $this->nota = htmlentities(addslashes($postNota));
    }
    /*GETTER*/
    public function getListaProfesores(){
        return $this->lista_Profesores;
    }

    public function enviarFormulario(){
        $consulta = "INSERT INTO encuesta (nota, comentario,idProfesor, fecha) VALUES (:NOTA,:COMENTARIO,(select id from usuarios where usuario = :PROFESOR),CURRENT_DATE)";
        $resultado=$this->db_conexion->prepare($consulta);
        $resultado->bindValue(":NOTA", $this->nota);
        $resultado->bindValue(":COMENTARIO", $this->comentario);
        $resultado->bindValue(":PROFESOR", $this->profesor);
        if ($resultado->execute()) {
            echo "CONEXION";
        } else {
            echo "ERROR";
        }
    }
    public function PrintListaProfesores(){
        for ($i = 0; $i < count($this->lista_Profesores); $i++) {
            echo "<option value=" . $this->lista_Profesores[$i][0] . ">" . $this->lista_Profesores[$i][0] . "</option>";
        }
    }

}
?>
<?php
require("Conexion.php");
class Form extends Conexion{
    private $profesor;
    private $lista_Profesores;
    private $comentario;
    private $nota;
    private $satifaccion;
    private $examenes;
    private $tareas;
    public function __construct(){
        parent::__construct();
        $consulta = "select usuario from usuarios where tipo= 'Usuario'";
        $resultado = $this->db_conexion->query($consulta);
        $this->lista_Profesores = $resultado->fetchAll();
    }
    /*SETTER*/
    public function setData($postComment,$postNota,$postSatifaccion,$postExamenes,$postTareas){
        $this->comentario = htmlentities(addslashes($postComment));
        $this->nota = htmlentities(addslashes($postNota));
        $this->satifaccion = htmlentities(addslashes($postSatifaccion));
        $this->examenes = htmlentities(addslashes($postExamenes));
        $this->tareas = htmlentities(addslashes($postTareas));
    }
    public function setProfesor($profesor){
        $this->profesor= $profesor;
    }
    /*GETTER*/
    public function getListaProfesores(){
        return $this->lista_Profesores;
    }

    public function enviarFormulario(){
        $consulta = "INSERT INTO encuesta (nota, comentario,satifaccion,tareas,examenes,idProfesor, fecha) VALUES (:NOTA,:COMENTARIO,:SATIFACCION,:TAREAS,:EXAMENES,(select id from usuarios where usuario = :PROFESOR),CURRENT_DATE)";
        $resultado=$this->db_conexion->prepare($consulta);
        $resultado->bindValue(":NOTA", $this->nota);
        $resultado->bindValue(":COMENTARIO", $this->comentario);
        $resultado->bindValue(":SATIFACCION", $this->satifaccion);
        $resultado->bindValue(":TAREAS", $this->tareas);
        $resultado->bindValue(":EXAMENES", $this->examenes);
        $resultado->bindValue(":PROFESOR", $this->profesor);
        if ($resultado->execute()) {
            echo "CONEXION";
        } else {
            echo "ERROR";
        }
    }
    public function PrintProfesoresHTMLSelect(){
        for ($i = 0; $i < count($this->lista_Profesores); $i++) {
            echo "<option value=" . $this->lista_Profesores[$i][0] . ">" . $this->lista_Profesores[$i][0] . "</option>";
        }
    }

}
?>
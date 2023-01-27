<?php
require("Conexion.php");
class Form extends Conexion{
    private $comentario;
    private $nota;
    private $lista_Profesores;
    public function __construct(){
        parent::__construct();
    }
    public function setComment($postComment,$postNota){
        $this->comentario = htmlentities(addslashes($postComment));
        $this->nota = htmlentities(addslashes($postNota));
    }
    public function setListaProfesores(){
        $consulta = "select usuario from usuarios;";
        $resultado = $this->db_conexion->query($consulta);
        $lista = $resultado->fetchAll();
        $this->lista_Profesores = $lista;
    }
    public function getListaProfesores(){
        return $this->lista_Profesores;
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
    public function PrintProfesores(){
        for ($i = 0; $i < count($this->lista_Profesores); $i++) {
            echo "<option value=" . $this->lista_Profesores[$i][0] . ">" . $this->lista_Profesores[$i][0] . "</option>";
        }
    }

}
?>
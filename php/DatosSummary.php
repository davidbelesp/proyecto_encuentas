<?php
require("Conexion.php");
class DatosSummary extends Conexion{
    public function __construct(){
        parent::__construct();

    }
    
    
    /*TO DO: EN UN FUTURO PASAR POR PARAMETRO EL PROFESOR Y HACER UN WHERE LIKE PROFESOR
    PARA SACAR LAS CONSULTAS DE UN UNICO PROFESOR
    */

    public function devolverDatosComentario(){

        $consulta = "SELECT comentario,fecha from encuesta";
        $resultado = $this->db_conexion->query($consulta);
        $comment_with_date = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $resultado->closeCursor();
        return $comment_with_date;
    }
    public function devolverDatosGenerales(){
            $consulta = "select sum(nota)/count(nota) from encuesta";
            $resultado = $this->db_conexion->query($consulta);
            $notaAvg = $resultado->fetch();
            $notaAvg = round($notaAvg[0],1);
            $resultado->closeCursor();


        return $notaAvg;

    }


/*STATIC METHOD*/



    /*IMPRIMIR COMENTARIO IZQ Y DERECHA*/
    public static function imprimirComentario($lado,$comentario_with_fecha){
        global $comentario_with_fecha;
        $guardado="";
        if($comentario_with_fecha!==NULL && ( $lado=="izquierda" ||$lado=="derecha" ) ){
            switch ($lado){
                case "izquierda":
                    for($i=0;$i<count($comentario_with_fecha);$i++){
                        if($i==0 || $i%2==0){
                            $guardado.="
                            <div class='comment box'>
                            <p id='comment-text'>".$comentario_with_fecha[$i]["comentario"]."</p>
                            <p id='date'>".$comentario_with_fecha[$i]["fecha"]."</p>
                            </div>";
                        }
                    }
                    return $guardado;
                    break;
                case "derecha":
                    for($i=0;$i<count($comentario_with_fecha);$i++){
                        if($i%2!=0){
                            $guardado.="
                            <div class='comment box'>
                            <p id='comment-text'>".$comentario_with_fecha[$i]["comentario"]."</p>
                            <p id='date'>".$comentario_with_fecha[$i]["fecha"]."</p>
                            </div>";
                        }
                    }
                    case "todos":
                        for($i=0;$i<count($comentario_with_fecha);$i++){
                                $guardado.="
                                <div class='comment box'>
                                <p id='comment-text'>".$comentario_with_fecha[$i]["comentario"]."</p>
                                <p id='date'>".$comentario_with_fecha[$i]["fecha"]."</p>
                                </div>";
                        }
                    return $guardado;
                    break;
            }
        }else{
            return "<div class='comment box'>
            <p id='comment-text'>ERROR</p>
            <p id='date'>ERROR</p>
            </div>";
        }
    }

    /*IMPRIMIR MENSAJE DEPENDE DE SI ES NULL O NO*/
    public static function switchPrintNullOrValueMessage(&$valorCompNull,$no_conecta,$conecta){
        if($valorCompNull==NULL){
            echo $no_conecta;
        }else{
            echo $conecta;
        }
    }
    
}

?>
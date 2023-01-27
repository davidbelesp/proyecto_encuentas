<?php
require("Conexion.php");
class DatosSummary extends Conexion{
    private $user;
    private $comment_with_date;
    private $notaAvg;
    public function __construct(){
        parent::__construct();
        $this->comment_with_date = NULL;
        $this->notaAvg = NULL;
        
    }
    
    
    /*TO DO: EN UN FUTURO PASAR POR PARAMETRO EL PROFESOR Y HACER UN WHERE LIKE PROFESOR
    PARA SACAR LAS CONSULTAS DE UN UNICO PROFESOR
    */

    public function setDatosComentario(){
        $consulta = "SELECT comentario,fecha from encuesta";
        $resultado = $this->db_conexion->query($consulta);
        $this->comment_with_date = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $resultado->closeCursor();
    }
    public function setDatosGenerales(){
        $consulta = "select sum(nota)/count(nota) from encuesta";
        $resultado = $this->db_conexion->query($consulta);
        $notaAvg = $resultado->fetch();
        $notaAvg = round($notaAvg[0],1);
        $this->notaAvg = $notaAvg;
        $resultado->closeCursor();
    }
    public function setUser($user){
        $this->user = $user;
        
    }
    public function getDatosComentario(){
        $resultado = $this->comment_with_date;
        return $resultado;
    }
    public function getDatosGenerales(){
        $resultado = $this->notaAvg;
        return $resultado;
    }

    /*IMPRIMIR E ITERAR COMENTARIO IZQ Y DERECHA*/
    public function printCommentAndDate($lado){
        $guardado="";
        if($this->comment_with_date!==NULL && ( $lado=="izquierda" ||$lado=="derecha" || $lado=="todos") ){
            switch ($lado){
                case "izquierda":
                    for($i=0;$i<count($this->comment_with_date);$i++){
                        if($i==0 || $i%2==0){
                            $guardado.="
                            <div class='comment box'>
                            <p id='comment-text'>".$this->comment_with_date[$i]["comentario"]."</p>
                            <p id='date'>".$this->comment_with_date[$i]["fecha"]."</p>
                            </div>";
                        }
                    }
                    return $guardado;
                case "derecha":
                    for($i=0;$i<count($this->comment_with_date);$i++){
                        if($i%2!=0){
                            $guardado.="
                            <div class='comment box'>
                            <p id='comment-text'>".$this->comment_with_date[$i]["comentario"]."</p>
                            <p id='date'>".$this->comment_with_date[$i]["fecha"]."</p>
                            </div>";
                        }
                    }
                    return $guardado;
                    case "todos":
                        for($i=0;$i<count($this->comment_with_date);$i++){
                                $guardado.="
                                <div class='comment box'>
                                <p id='comment-text'>".$this->comment_with_date[$i]["comentario"]."</p>
                                <p id='date'>".$this->comment_with_date[$i]["fecha"]."</p>
                                </div>";
                        }
                    return $guardado;
            }
        }else{
            return "<div class='comment box'>
            <p id='comment-text'>ERROR</p>
            <p id='date'>ERROR</p>
            </div>";
        }
    }

    

/*STATIC METHOD*/

    /*IMPRIMIR MENSAJE DEPENDE DE SI ES NULL O NO*/
    public static function switchPrintNullOrValueMessage($valorCompNull,$no_conecta,$conecta){
        if($valorCompNull==NULL){
            echo $no_conecta;
        }else{
            echo $conecta;
        }
    }
    
}

?>
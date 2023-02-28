<?php
require_once("Conexion.php");
class DatosSummary {
    private $comment_with_date;
    private $notaAvg;
    private $satisfecho;
    private $noSatisfecho;
    private $examenesAvg;
    private $tareasAvg;
    private $datosGrafico;
    private $enActivada;
    
    public function __construct($profesor){
        
        if(Conexion::getConexion()!=NULL){
            /*PROFE ACTIVADO*/
            $consulta = "SELECT encActivada from usuarios where usuario = '$profesor'";
            $resultado = Conexion::getConexion()->query($consulta);
            $this->enActivada = $resultado->fetch();
            /*DATO COMENTARIO*/
            $consulta = "SELECT comentario,fecha from encuesta where comentario <> '' and idProfesor=(select id from usuarios where usuario = '$profesor')";
            $resultado = Conexion::getConexion()->query($consulta);
            $this->comment_with_date = $resultado->fetchAll(PDO::FETCH_ASSOC);
            /*DATOS GENERALES*/
            $consulta = "select sum(nota)/count(nota),sum(examenes)/count(examenes),sum(tareas)/count(tareas) from encuesta where idProfesor = (select id from usuarios where usuario='$profesor')";
            $resultado = Conexion::getConexion()->query($consulta);
            $resultado = $resultado->fetch();

            $this->notaAvg = round($resultado[0],1);
            $this->examenesAvg = round($resultado[1],1);
            $this->tareasAvg = round($resultado[2],1);
            
            /*DATOS POR DIA CON FECHA*/
            $consulta = "select fecha,sum(nota)/count(nota),sum(examenes)/count(examenes),sum(tareas)/count(tareas) from encuesta where idProfesor = (select id from usuarios where usuario='$profesor') group by fecha order by fecha asc;";
            $resultado = Conexion::getConexion()->query($consulta);
            $resultado = $resultado->fetchAll();
            
            $this->datosGrafico = $resultado;

            /*SATISFECHO E INSATISFECHO*/
            $consulta = "SELECT count(satifaccion) from encuesta where idProfesor=(select id from usuarios where usuario = '$profesor') and satifaccion='si'";
            $resultado =Conexion::getConexion()->query($consulta);
            $resultado = $resultado->fetch();
            $this->satisfecho = $resultado[0];

            $consulta = "SELECT count(satifaccion) from encuesta where idProfesor=(select id from usuarios where usuario = '$profesor') and satifaccion='no'";
            $resultado = Conexion::getConexion()->query($consulta);
            $resultado = $resultado->fetch();
            $this->noSatisfecho = $resultado[0];
            $resultado=NULL;
        }else{
            $this->notaAvg= NULL;
            $this->comment_with_date = NULL;
        }
    }
    /*GETTERS*/
    public function getDatosComentario(){
        return $this->comment_with_date;
    }
    public function getNota(){
        return $this->notaAvg;
    }
    public function getExamen(){
        return $this->examenesAvg;
    }
    public function getTareas(){
        return $this->tareasAvg;
    }
    public function getSatisfecho(){
        return $this->satisfecho;
    }
    public function getNoSatisfecho(){
        return $this->noSatisfecho;
    }

    public function getdatosGrafico(){
        return $this->datosGrafico;
    }
    public function IsEncActivada(){
        return $this->enActivada[0];
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
        if($valorCompNull===NULL){
            echo $no_conecta;
        }else{
            echo $conecta;
        }
    }
    
}

?>
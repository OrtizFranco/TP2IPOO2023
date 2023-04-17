<?php
/* La empresa de Transporte de Pasajeros “Viaje Feliz” quiere registrar la información
 referente a sus viajes. De cada viaje se precisa almacenar el código del mismo, destino,
  cantidad máxima de pasajeros y los pasajeros del viaje.

Realice la implementación de la clase Viaje e implemente los métodos necesarios para
 modificar los atributos de dicha clase (incluso los datos de los pasajeros).
  Utilice un array que almacene la información correspondiente a los pasajeros.
   Cada pasajero es un array asociativo con las claves “nombre”, “apellido” y
    “numero de documento”.

Implementar un script testViaje.php que cree una instancia de la clase Viaje y presente
 un menú que permita cargar la información del viaje, modificar y ver sus datos.
*/
//retorna el array de pasajeros

  

 function cargarArray(){
    $arrayPasajeros = [];
    $p1 = ["nombre"=>"pepe", "apellido"=>"martinez","DNI"=>123456];
    $p2 = ["nombre"=>"papo", "apellido"=>"perez","DNI"=>123457];
    $p3 = ["nombre"=>"pipa", "apellido"=>"dublre","DNI"=>123458];
    $p4 = ["nombre"=>"popi", "apellido"=>"mark","DNI"=>123459];
    $p5 = ["nombre"=>"popa", "apellido"=>"mendez","DNI"=>123460];
    array_push($arrayPasajeros,$p1,$p2,$p3,$p4,$p5);
    return $arrayPasajeros;
 }

    function mostrarViajeCod($arrayDeViajes){
        $cant = count($arrayDeViajes);
        if ($cant>0){
        for ($i=0;$i<count($arrayDeViajes);$i++){
            $viaje=  $arrayDeViajes[$i];
            $cod = $viaje->getCodigo();
            $dest = $viaje->getDestino();
            echo "Viaje n°".($i+1).": destino ".$dest." codigo: ".$cod." \n";
        }
        
        do{
            echo "Ingrese el número de viaje que desea ver \n";
            $cod=trim(fgets(STDIN));
            $cod = $cod-1;
        if (is_numeric($cod) || esNumEntre($cod,0,(count($arrayDeViajes)-1))){
            echo $arrayDeViajes[$cod];
        }else{
            echo "Ingrese un numero entre 1 y ".count($arrayDeViajes);
        }}while(!is_numeric($cod) || !esNumEntre($cod,0,(count($arrayDeViajes)-1)));
     }else{
        echo "No existe ningún viaje para mostrar \n";
     }
    }


 //muestra el menu de opciones
 function cargarMenu(){
echo "Bienvenid@!!!<\n>";
echo "¿Qué operación desea realizar?<\n>";
echo "1 para crear un nuevo viaje \n";
echo "Ingresar 2 para cargar información de un viaje<\n>";
echo "Ingresar 3 para modificar algún aspecto de un viaje<\n>";
echo "Ingrese 4 para ver algún aspecto de un viaje<\n>";
 }
  
 //crear un objeto viaje
function crearViaje($viajes){
    //inicializo variables
    
    $arrayDeViajes = $viajes;
    $arrayPsjs = [];
    $arrayPsjs = cargarArray();
    if (isset($arrayDeViajes)){
        $pos= count($arrayDeViajes);
    }else{
        $pos=0;
    }
    echo "Ingrese el código del viaje \n";
    $cod=trim(fgets(STDIN));
    echo "Ingrese el destino del viaje \n";
    $destino=trim(fgets(STDIN));
    echo "Ingrese la cantidad máxima de pasajeros del viaje \n";
    $cantMax=trim(fgets(STDIN));
    $v1 = new Viaje ($cod, $destino, $cantMax, $arrayPsjs);
    echo $pos;
    $arrayDeViajes[$pos] = $v1;
    return $arrayDeViajes;
}


 //modificar algun atributo del viaje, recibe objeto-Viaje. Retorna el obj modificado
 function modificarDatos($viajes){
    $arrayDeViajes = $viajes;
    $cant = count($arrayDeViajes);
        if ($cant>0){
        for ($i=0;$i<count($arrayDeViajes);$i++){
            $viaje=  $arrayDeViajes[$i];
            $cod = $viaje->getCodigo();
            $dest = $viaje->getDestino();
            echo "Viaje n°".($i+1).": destino ".$dest." codigo: ".$cod." \n";
        }
        echo "Ingrese el número de viaje que desea ver \n";
        $pos=trim(fgets(STDIN));
        $pos=$pos-1;
        while(!is_numeric($pos) || !esNumEntre($pos,0,(count($arrayDeViajes)-1))){
            echo "ingrese un número de viaje válido \n";
            $pos=trim(fgets(STDIN));
        }
        $objV = $arrayDeViajes[$pos];
        echo "¿qué dato desea modificar?<\n>";
        echo "Ingrese 1 para modificar el código de viaje<\n>";
        echo "Ingrese 2 para modificar el destino<\n>";
        echo "Ingrese 3 para modificar la cantidad máxima de pasajeros del viaje<\n>";
        echo "Ingrese 4 para modificar los datos de algún pasajero<\n>";
        $respuesta = trim(fgets(STDIN));
        switch($respuesta){
        case 1:
            echo "Ingrese un nuevo código para el viaje<\n>";
            $mod = trim(fgets(STDIN));
            $objV->setCodigo($mod);
            break;
        case 2:
            echo "Ingrese un nuevo destino para el viaje<\n>";
            $mod = trim(fgets(STDIN));
            $objV->setDestino($mod);
            break;
        case 3:
            echo "Ingrese un nuevo valor para la cantidad máxima de pasajeros del viaje<\n>";
            $mod = trim(fgets(STDIN));
            $objV->setCantPasajeros($mod);
            break;
        case 4:
            echo "Ingrese el DNI del pasajero a modificar<\n>";
            $doc = trim(fgets(STDIN));
            $psjs = $objV->getPasajeros();
            for ($i=0;$i<count($psjs);$i++){
                if ($doc == $psjs[$i]["DNI"]){
                    echo "Ingrese el nuevo nombre<\n>";
                    $nom = trim(fgets(STDIN));
                    echo "Ingrese el apellido<\n>";
                    $ape = trim(fgets(STDIN));
                    echo "Ingrese el DNI<\n>";
                    $nuevoDoc = trim(fgets(STDIN));
                    $psjs = array ("nombre"=>$nom,"apellido"=>$ape,"DNI"=>$nuevoDoc);
                    $objV->setPasajeros($psjs,$i);
                    break;
                }
            }
    }
    $arrayDeViajes[$pos] = $objV;
    return $arrayDeViajes;
    }else{
        echo "no existen viajes para modificar \n";
    }
 }
 function esNumEntre($num,$min,$max){
    if ($num<=$max && $num>=$min){
        $esNum=true;
    }else{
        $esNum=false;
    }
    return $esNum;
 }
//permite ver algun atributo del viaje, recibe el objeto-Viaje por parametro
 function verDato($viajes){
    $arrayDeViajes = $viajes;
    $cant = count($arrayDeViajes);
    if ($cant>0){
        for ($i=0;$i<count($arrayDeViajes);$i++){
            $viaje=  $arrayDeViajes[$i];
            $cod = $viaje->getCodigo();
            $dest = $viaje->getDestino();
            echo "Viaje n°".($i+1).": destino ".$dest." codigo: ".$cod." \n";
        }
        echo "Ingrese el número de viaje que desea ver \n";
        $pos=trim(fgets(STDIN));
        $pos=$pos-1;
        while(!is_numeric($pos) || !esNumEntre($pos,0,(count($arrayDeViajes)-1))){
            echo "ingrese un número de viaje válido";
            $pos=trim(fgets(STDIN));
        }
        $objV = $arrayDeViajes[$pos];
    

    echo "¿qué dato del viaje desea ver? \n";
    echo "Ingrese 1 para ver el código del viaje \n";
    echo "Ingrese 2 para ver el destino de un viaje\n";
    echo "Ingrese 3 para ver la cantidad máxima de pasajeros del viaje \n";
    echo "Ingrese 4 para ver los datos de los pasajeros \n";
    $eleccion = trim(fgets(STDIN));
    switch ($eleccion){
        case 1:
            echo "codigo de viaje ".$objV->getCodigo()."\n";
            break;
        case 2:
            echo "destino de viaje ".$objV->getDestino()."\n";
            break;
        case 3:
            echo "codigo de viaje ".$objV->getCantPasajeros()."\n";
            break;
        case 4:
            $p = $objV->getPasajeros();
            for ($i=0;$i<count($p);$i++){
                echo "Pasajero ".$i+1 .": \n";
                echo "  nombre y apellido: ".$p[$i]["nombre"]." ".$p[$i]["apellido"]." documento : ".$p[$i]["DNI"]."\n";
            }
            break;
    }
 }else{
    echo "no existen viajes para mostrar \n";
 }
}

//clase responsableV
class ResposableViaje{
   // número de empleado, número de licencia, nombre y apellido
   private $numEmpleado;
   private $numLicencia;
   private $nombreYApellido;

   public function __construct($numE,$numL,$nomYAp){
    $this-> numEmpleado = $numE;
    $this-> numLicencia = $numL;
    $this-> nombreYApellido = $nomYAp;
   }
   //gets y sets de la clase
   public function getNumEmpleado(){
    return $this->numEmpleado;
}
public function setNumEmpleado($num){
    $this->numEmplead = $num;
}
//gets y sets de la clase
public function getNumLicencia(){
    return $this->numLicencia;
}
public function setNumLicencia($num){
    $this-> NumLicencia = $num;
}
//gets y sets de la clase
public function getNombreYApellido(){
    return $this->nombreYApellido;
}
public function setNombreYApellido($nom){
    $this->nombreYApellido = $nom;
}
}
 //Clase Viaje;
class Viaje{
    
    private $codigo;
    private $destino;
    private $cant_Max_Pjs;
    private $pasajeros = [];
    private $responsableViaje;
    //metodo constructor, recibe datos desde el test
    public function __construct($codigo, $destino, $cant, $pasajeros,$responsable){
        $this-> codigo = $codigo;
        $this-> destino = $destino;
        $this -> cant_Max_Pjs = $cant;
        $this -> pasajeros = $pasajeros;
        $this -> responsableViaje = $responsable;
    }

    //gets y sets de la clase
    //gets y sets de la clase
    public function getResponsable(){
        return $this->responsableViaje;
    }
    public function setResponsable($responsable){
        $this->resposableViaje = $responsable;
    }
    public function getCodigo(){
        return $this->codigo;
    }
    public function setCodigo($cod){
        $this->codigo = $cod;
    }
    public function getDestino(){
        return $this->destino;
    }
    public function setDestino($dest){
        $this->destino = $dest;
    }
    public function getCantPasajeros(){
        return $this->cant_Max_Pjs;
    }
    public function setCantPasajeros($cantP){
        $this->cant_Max_Pjs = $cantP;
    }
    public function getPasajeros(){
        return $this->pasajeros;
    }
    public function setPasajeros($pasajero,$posicion){
        $this->pasajeros[$posicion] = $pasajero;
    }
    //retorna el string a mostrar en __toString()
    public function cargarString(){
        $s = "codigo de viaje: ".$this->codigo."\n". " destino: ".$this->destino."\n". " cantidad máxima de pasajeros: ".$this->cant_Max_Pjs."\n";
        $cant_P = count($this->pasajeros);
        $p="";
        for ($i=0;$i<$cant_P;$i++){
            $p = $p. "pasajero ".$i+1 ." DNI: ".$this->pasajeros[$i]["DNI"]." nombre " .$this->pasajeros[$i]["nombre"]." ".$this->pasajeros[$i]["apellido"]."\n";
        }
        $s = $s.$p;
        return $s;
    }
    // al hacer echo muestra los atributos de la clase
    public function __toString(){
        $string=$this->cargarString();
        return $string;
    }

}

?>
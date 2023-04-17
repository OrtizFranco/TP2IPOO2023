<?php
/* Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos
 nombre, apellido, numero de documento y teléfono. El viaje ahora contiene una referencia a una
  colección de objetos de la clase Pasajero. También se desea guardar la información de la 
  persona responsable de realizar el viaje, para ello cree una clase ResponsableV que registre
   el número de empleado, número de licencia, nombre y apellido. La clase Viaje debe hacer 
   referencia al responsable de realizar el viaje.

Volver a implementar las operaciones que permiten modificar el nombre, apellido y teléfono de
un pasajero. Luego implementar la operación que agrega los pasajeros al viaje, solicitando por
  consola la información de los mismos. Se debe verificar que el pasajero no este cargado mas
   de una vez en el viaje. De la misma forma cargue la información del responsable del viaje.*/

   include 'viajefeliz.php';


//cargo el menu y obtengo la respuesta del usuario
$viajes = [];
do{
cargarMenu();

$min=1;
$max=4;
do{
    $seleccion = trim(fgets(STDIN));
    if (esNumEntre($seleccion,$min,$max)){
    switch($seleccion){
    case 1:
        $viajes=crearViaje($viajes);
        break;
    case 2:
        //pido num del viaje a mostrar
        mostrarViajeCod($viajes);
        break;
    case 3:
        $viajes = modificarDatos($viajes);
        break;
    case 4:
        verDato($viajes);
        break;
}}else{
    echo "Ingrese un numero entre 1 y 4 \n";

}
}while(!esNumEntre($seleccion,$min,$max));
echo "¿Desea realizar otra operación? S/N \n";
$respuesta = trim(fgets(STDIN));
}while($respuesta== "S" || $respuesta== "s");

?>
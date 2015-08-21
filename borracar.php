<?php 
/*
<!--  
///********************************************************
PAGINA FUNCIONAL (Funcional o de visualización)
FINALIDAD:      Borra los productos al carrito
FECHA:           Noviembre, 2013
DESARROLLADO:    claretcoromoto@hotmail.ES  victor_rosendo@hotmail.com
MODIFICADO:          Nombre / Fecha / #Release
///********************************************************
*/
include 'includes/sesion.class.php';
$sesion = new sesion();
//session_start();
//error_reporting(E_ALL);
//@ini_set('display_errors', '1');
//con session_start() creamos la sesión si no existe o la retomamos si ya ha sido creada
extract($_GET);
$carro=$sesion->get('carrito');
//la función extract toma las claves de una matriz asoiativa y las convierte en nombres de variable,
//asignándoles a esas variables valores iguales a los que tenía asociados en la matriz. Es decir, convierte a $_GET['id'] en $id,
//sin que tengamos que tomarnos el trabajo de escribir $id=$_GET['ID']; 
//depositamos en la variable carro todos los datos que el usuario agregue al carrito.
unset($carro[md5($cod_repuesto)]);
//deshacemos la sesi�n creada con md5, osea la sesion criptada. md5(encripta datos de sesi�n) 

$sesion->set('carrito', $carro);
//volvemos a depositar lo que el usuario haya agregado despues de eliminar un producto.

header("Location:vercarrito.php?".SID);
//lo redireccionamos a catalogo.php con su SID que es un id que nos sirve para identificar al usuario cuando ingresa a nuestro sistema. 
?>

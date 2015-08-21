<?php
include 'includes/sesion.class.php';
 include 'includes/ConexionPGSQL.php';
$s = new sesion();

//con session_start() creamos la sesión si no existe o la retomamos si ya ha sido creada
extract($_REQUEST);
//la función extract toma las claves de una matriz asoiativa y las convierte en nombres de variable,
//asignándoles a esas variables valores iguales a los que tenía asociados en la matriz. Es decir, convierte a $_GET['id'] en $id,
//sin que tengamos que tomarnos el trabajo de escribir $id=$_GET['ID']; 

if (!isset($Cantidad)) {
    $Cantidad = 1;
}
//Como también vamos a usar este archivo para actualizar las cantidades,
//hacemos que cuando la misma no esté indicada sea igual a 1
$qry = pg_query("SELECT cod_repuesto, nu_precio_contado, nu_precio_credito, nu_cant_disponible FROM tblxian_repuesto where cod_repuesto='" . $cod_repuesto . "' ");
$row = pg_fetch_array($qry);
//Si ya hemos introducido algún producto en el carro lo tendremos guardado temporalmente
//en el array superglobal $_SESSION['carro'], de manera que rescatamos los valores de dicho array
//y se los asignamos a la variable $carro, previa comprobación con isset de que $_SESSION['carro']
//ya haya sido definida
if ($s->get('carrito'))
    $carro = $s->get('carrito');
//Ahora introducimos el nuevo producto en la matriz $carro, utilizando como índice el id del producto
//en cuestión, encriptado con md5. Utilizamos md5 porque genera un valor alfanumérico que luego,
//cuando busquemos un producto en particular dentro de la matriz, no podrá ser confundido con la posición
//que ocupa dentro de dicha matriz, como podría ocurrir si fuera sólo numérico.
//Cabe aclarar que si el producto ya había sido agregado antes, los nuevos valores que le asignemos reemplazarán
//a los viejos. 
//Al mismo tiempo, y no porque sea estrictamente necesario sino a modo de ejemplo, guardamos más de un valor 
//en la variable $carro, valiéndonos de nuevo de la herramienta array.
$carro[md5($cod_repuesto)] = array('identificador' => md5($cod_repuesto),
    'Cantidad' => $Cantidad,
    'contado' => $row['nu_precio_contado'],
    'credito' => $row['nu_precio_credito'],
    'stock' => $row['nu_cant_disponible'],
    'cod_repuesto'=>$cod_repuesto
);
//Ahora dentro de la sesión ($_SESSION['carro']) tenemos sólo los valores que teníamos (si es que teníamos alguno) antes de ingresar
//a esta página y en la variable $carro tenemos esos mismos valores más el que acabamos de sumar. De manera que 
//tenemos que actualizar (reemplazar) la variable de sesión por la variable $carro.
$s->set('carrito', $carro);
//Y volvemos a nuestro catálogo de artículos. La cadena SID representa al identificador de la sesión, que, dependiendo 
//de la configuración del servidor y de si el usuario tiene o no activadas las cookies puede no ser necesario pasarla por la url.
//Pero para que nuestro carro funcione, independientemente de esos factores, conviene escribirla siempre.
header("Location:vercarrito.php?" . SID);



 /*
<!--  
///********************************************************
PAGINA FUNCIONAL (Funcional )
FINALIDAD:      Añade los productos al carrito
FECHA:          2014
DESARROLLADO:   claretcoromoto@hotmail.ES  victor_rosendo@hotmail.com
MODIFICADO:          Nombre / Fecha / #Release
///********************************************************
*/
?>
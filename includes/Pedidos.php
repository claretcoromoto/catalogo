<?php    error_reporting (0);
require_once "sesion.class.php";
$sesion = new sesion();
include_once "DaoTercerNivel.php";

 extract($_REQUEST);
if (isset($_POST["submit"])) {

    if ($sesion->get('carrito')) {
     
       
        if (isset($direccion) == '' && isset($direcciondes) =='')
            $direccion = 'En la tienda';
        else if (isset($direccion))
            $direccion = trim(htmlentities(strip_tags($_POST['direccion'])));
         else 
             $direccion = trim(htmlentities(strip_tags($_POST['direcciondes'])));
        $fecharegistro = date("d-m-Y");
         $daotercer = new DaoTercerNivel();
              
       
        $result = $daotercer->insertarPedido($idusr,$fecharegistro,$rif, $idautorii, $entrega, $direccion, $idstatus, $f, $montos);
            
        $id = @pg_fetch_array($result);
        $id_pedido = $id['id_pedido'];
        if (!isset($result)) {
              $remote_addr = $_SERVER['REMOTE_ADDR'];
                        $lo->Traza('Pedido',  'Pedido No registrado por id: '.$idusr.' en: ->'. $remote_addr, $rif);
            echo "<script language='JavaScript'> alert('No se ha podido registrar el pedido') 
                          location.href = '../vercarrito.php';
                          exit();
                          </script> ";
        } else if (isset($result)) {//si inserto el pedido en tblxian_pedido
            //si existe la variable de sesión del carrito 
            $carro = $sesion->get('carrito');
            $contarcodigoreservado = 0;
            foreach ($carro as $key => $value) {//recorremos el carrito
                $cod_repuesto = $value['cod_repuesto'];
                $cantidad = $value['Cantidad'];
                $row = $daotercer->selectNumCodRepuesto($cod_repuesto);
                if (isset($row)) {//si existe en tblxian_cantidad_dispon
                    $fetch = $daotercer->selectCod_dispon($cod_repuesto);
                    $dispo = $fetch['nu_disp_valery'];
                    $dispo2 = $fetch['nu_cant_reservada'];
                    $total = ($dispo - $dispo2);
           
                    if ($total >= $value['Cantidad']) {//si hay disponible la cantidad necesaria de repuestos
                        $fetch = $daotercer->selectCod_reserva_dispon($cod_repuesto);
                        $guardarcantidadreservada = $fetch['nu_cant_reservada'];
                        $suma = $guardarcantidadreservada + $cantidad;
                        $daotercer->actualizarCantReservada($suma, $value['cod_repuesto']);
                        $contarcodigoreservado++;
                    } else {//si no existe la cantidad suficiente
                        //   echo '\n si no existe la cantidad suficiente';
                        if ($contarcodigoreservado > 0) {
                            for ($index = 0; $index < count($carro); $index++) {
                                $daotercer->actualizarDevolver($carro[$index]['Cantidad'], $carro[$index]['cod_repuesto']);
                            }
                            $contarcodigoreservado = 0;
                        }
                        //echo 'Esta entrando en el else de no conseguir la cantidad segunda parte';
                        echo "<script language='JavaScript'> alert('No hay suficiente cantidad de repuestos ) 
                          location.href = '../Registrar_Pedido.php';
                          exit();
                          </script> ";
                    }
                } else {

                    $fila = $daotercer->selectCant_tblxian_repuesto($cod_repuesto, $cantidad);
                    if (isset($fila)) {
                        $cantidadisponible = $fila['nu_cant_disponible'];
                        $daotercer->insertarReserva($cod_repuesto, $cantidadisponible, $cantidad);
                        $contarcodigoreservado++;
                    } else {
                        if ($contarcodigoreservado > 0) {
                            for ($index = 0; $index < count($carro); $index++) {
                                $obtenercodigoreservado = $carro[$index]['cod_repuesto'];
                                $obtenercantidadreservada = $carro[$index]['Cantidad'];
                                $daotercer->actualizarNuCantReserva($obtenercantidadreservada, $obtenercodigoreservado);
                            }
                            $contarcodigoreservado = 0;
                            echo "<script language='JavaScript'> alert('No hay suficiente cantidad de: ''" . $cod_repuesto . "') 
                          location.href = '../vercarrito.php';
                          exit();
                          </script> ";
                        }
                    }
                }
            }

            if (count($carro) == $contarcodigoreservado) {
                foreach ($carro as $key => $detalle) {
                 $detallecodigo = $detalle['cod_repuesto'];
                 $detallecantidad = $detalle['Cantidad'];
                 $detallecontado = $detalle['contado'];
                  $detallecredito = $detalle['credito'];
                  if (strcmp( trim(htmlentities(strip_tags($f))), 'contado') === 0) {
                       $daotercer->insertarDetallePedido($detallecodigo, $detallecontado, $detallecantidad, $id_pedido);
                        $sesion->elimina_variable('carrito');
                        $remote_addr = $_SERVER['REMOTE_ADDR'];
                            $lo->Traza('Pedido',  'Registro exitoso por id: '.$idusr.' DATOS->IP:'. $remote_addr.' FORMAPAGO: De contado RIF:'.$rif, 'BD');    echo "<script language='JavaScript'> alert('Registro detalle del pedido # " . $id_pedido . "  ha sido realizado exitosamente') 
                          location.href = '../catalogo_final.php';
                          exit();
                          </script> ";
                    } else if (strcmp( trim(htmlentities(strip_tags($f))), 'credito') === 0) {
                        $daotercer->insertarDetallePedido($detallecodigo, $detallecredito, $detallecantidad, $id_pedido);
                        $sesion->elimina_variable('carrito');
          $remote_addr = $_SERVER['REMOTE_ADDR'];
                        $lo->Traza('Pedido',  'Registro exitoso por id: '.$idusr.' DATOS->IP:'. $remote_addr.' FORMAPAGO: A crédito RIF:'.$rif, 'BD');
                   echo "<script language='JavaScript'> alert('Registro  detalle del pedido # " . $id_pedido . " ha sido realizado exitosamente') 
                            location.href = '../catalogo_final.php';
                          exit();
                          </script> ";
                    }
                }/// fin del for
                $sesion->elimina_variable('carrito');
            } else {
                echo "<script language='JavaScript'> alert('No hay suficiente cantidad de:  " . $cod_repuesto . "') 
                  location.href = '../vercarrito.php';
                          exit();
                          </script> ";
            }
        } else {
            $remote_addr = $_SERVER['REMOTE_ADDR'];
                        $lo->Traza('Pedido',  'Pedido No registrado por id: '.$idusr.' en: ->'. $remote_addr, $rif);
            echo "<script language='JavaScript'> alert('El pedido no se ha registrado') 
                          location.href = '../catalogo_final.php';
                          exit();
                          </script> ";
        }
    } else {
        echo "<script language='JavaScript'> alert('El carrito est\u00e1 vacio ') 
                          location.href = '../vercarrito.php';
                          exit();
                          </script> ";
    }
} else {
           echo "<script language='JavaScript'> alert('Pedido cancelado') 
                          location.href = '../catalogo_final.php';  exit();  
                          </script> ";   
   
}
?>


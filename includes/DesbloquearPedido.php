<?php

require_once "sesion.class.php";
$sesion = new sesion();
include_once "DaoTercerNivel.php";


if (isset($_POST["enviar"])) {
if ($sesion->get('carrito')) {
  
    //si inserto el pedido en tblxian_pedido
            //si existe la variable de sesión del carrito 
            $daotercer = new DaoTercerNivel();
 
            $contarcodigoreservado = 0;
            $carro=$sesion->get('carrito');
            foreach ($carro as $key => $value) {//recorremos el carrito
             echo   $cod_repuesto = $value['cod_repuesto'];
                $cantidad = $value['in_cantidad'];
                $row = $daotercer->selectNumCodRepuesto($cod_repuesto);
                if (isset($row)) {//si existe en tblxian_cantidad_dispon
                    $fetch = $daotercer->selectCod_dispon($cod_repuesto);
                    $dispo = $fetch['nu_disp_valery'];
                    $dispo2 = $fetch['nu_cant_reservada'];
                    $total = $dispo - $dispo2;
                    //  echo $total;
                    if ($total >= $value['in_cantidad']) {//si hay disponible la cantidad necesaria de repuestos
                        $fetch = $daotercer->selectCod_reserva_dispon($cod_repuesto);
                        $guardarcantidadreservada = $fetch['nu_cant_reservada'];
                        $suma = $guardarcantidadreservada + $cantidad;
                        $daotercer->actualizarCantReservada($suma, $value['cod_repuesto']);
                        $contarcodigoreservado++;
                    } else {//si no existe la cantidad suficiente
                        //   echo '\n si no existe la cantidad suficiente';
                        if ($contarcodigoreservado > 0) {
                            for ($index = 0; $index < count($carro); $index++) {
                                $daotercer->actualizarDevolver($carro[$index]['in_cantidad'], $carro[$index]['cod_repuesto']);
                            }
                            $contarcodigoreservado = 0;
                        }
                        //echo 'Esta entrando en el else de no conseguir la cantidad segunda parte';
                        echo "<script language='JavaScript'> alert('No hay suficiente cantidad de repuestos ) 
                          location.href = '../AdminSolPenCliPedidos.php';
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
                                $obtenercantidadreservada = $carro[$index]['in_cantidad'];
                                $daotercer->actualizarNuCantReserva($obtenercantidadreservada, $obtenercodigoreservado);
                            }
                            $contarcodigoreservado = 0;
                            echo "<script language='JavaScript'> alert('No hay suficiente cantidad de: '.'" . $cod_repuesto . "') 
                          location.href = '../AdminSolPenCliPedidos.php';
                          exit();
                          </script> ";
                        }
                    }
                }
            }

            if (count($carro) == $contarcodigoreservado) {
                foreach ($carro as $key => $detalle) {
                 $detallecodigo = $detalle['cod_repuesto'];
                 $detallecantidad = $detalle['in_cantidad'];
                 $detallecontado = $detalle['contado'];
                  $detallecredito = $detalle['credito'];
                  if (strcmp( trim(htmlentities(strip_tags($formpago))), 'contado') === 0) {
                        $daotercer->insertarDetallePedido($detallecodigo, $detallecontado, $detallecantidad, $id_pedido);
                        $sesion->elimina_variable('carrito');
                        echo "<script language='JavaScript'> alert('Registro detalle del pedido # " . $id_pedido . "  ha sido realizado exitosamente') 
                           Refresh: 2; location.href = '../AdminSolPenCliPedidos.php';
                          exit();
                          </script> ";
                    } else if (strcmp( trim(htmlentities(strip_tags($formpago))), 'credito') === 0) {
                        $daotercer->insertarDetallePedido($detallecodigo, $detallecredito, $detallecantidad, $id_pedido);
                        $sesion->elimina_variable('carrito');
                        echo "<script language='JavaScript'> alert('Registro  detalle del pedido # " . $id_pedido . " ha sido realizado exitosamente') 
                           Refresh: 2; location.href = '../AdminSolPenCliPedidos.php';
                          exit();
                          </script> ";
                    }
                }/// fin del for
                $sesion->elimina_variable('carrito');
            } else {
                echo "<script language='JavaScript'> alert('No hay suficiente cantidad de:  " . $cod_repuesto . "') 
                  location.href = '../AdminSolPenCliPedidos.php';
                          exit();
                          </script> ";
            }
        
    } else {
        echo "<script language='JavaScript'> alert('El carrito est\u00e1 vacio ') 
                           location.href = '../AdminSolPenCliPedidos.php';
                          exit();
                          </script> ";
    }
} else {
    echo "<script language='JavaScript'> alert('Formatos inv\u00e1lidos') 
                          location.href = '../AdminSolPenCliPedidos.php';
                          exit();
                          </script> ";
}
?>


<?php
error_reporting(0);
include 'ConexionPGSQL.php';
include 'sesion.class.php';


$sesion = new sesion();

//establecemos un valor para los errores presentados y si es que existen colocaremos en lugar de estos el valor 1.
if (!$sesion->get('carrito')){
//si no existe la variable de sesión carro 
    echo "<script language='JavaScript'> alert('Carrito false') 
     location.href = 'catalogo_final.php';
    </script> ";
}else{

            $carro = $sesion->get('carrito');
            $rol = $sesion->get('id_rol_usr');
            $id = $sesion->get("id_usr");
            $formpago= $sesion->get('formpago');
            $mon = $sesion->get('monto');
            $moni = $sesion->get('montiva');
            $montal = $sesion->get('montotal');
extract($_REQUEST);

   try {
$sql = "INSERT INTO tblxian_tpo_entrega (in_activo, tx_direccion, ci_rif_cliente)  VALUES (1,'" .$nuevadir . "','" . $rif . "' ) ";  
$result = @pg_query($sql);

    if (isset($result)) {
     
            echo "<script language='JavaScript'>  alert('La nueva  direcci\u00f3n ha sido registrada')                     
                       location.href = '../Registrar_pedido.php?rif=$rif&formpago=$formpago&monto=$mon&montiva=$moni&montotal=$montal';exit();</script> ";
         
        } else {
        echo "<script language='JavaScript'>     alert('No se ha podido registrar la direcci\u00f3n')           
                       location.href = '../Registrar_pedido.php?rif=$rif&formpago=$formpago&monto=$mon&montiva=$moni&montotal=$montal';exit();</script> ";
             
        }
} catch (Exception $e) {
    $this->SetError($e->getMessage());
    if ($this->exceptions) {
        throw $e;
        echo "<script language='JavaScript'> alert('Ha ocurrido una excepci\u00f3n en el envio: " . $e . "') 
                        location.href = '../Registrar_pedido.php'; exit();
                         </script> ";
    }
}
}
?>

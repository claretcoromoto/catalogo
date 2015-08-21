<?php
require_once "sesion.class.php";
$sesion = new sesion();
include 'ConexionPGSQL.php';
extract($_REQUEST);

$sesion->get('monto');
$sesion->get('montiva');
$sesion->get('montotal');
$sesion->get('entrega');
try {

  //echo  $sql = "UPDATE tblxian_tpo_entrega SET tx_direccion='" . $nuevadir . "',   ci_rif_cliente ='" . $rif . "'  WHERE nb_tpo_entrega=Nueva  ";
   // $result = @pg_query($sql);
  $sql = "INSERT INTO tblxian_tpo_entrega (tx_direccion, ci_rif_cliente)  VALUES ('" . $direccion . "', '" . $rif . "') ";
    $result = @pg_query($sql);
    if (isset($result)) {
        echo "<script language='JavaScript'> alert('Registro exitoso ') 
                          location.href = '../Registrar_pedido.php';
                          exit();
                          </script> ";
    } 
} catch (Exception $e) {
    $this->SetError($e->getMessage());
    if ($this->exceptions) {
        throw $e;
        echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                        location.href = '../Registrar_pedido.php'; exit();
                         </script> ";
    }
}
?>

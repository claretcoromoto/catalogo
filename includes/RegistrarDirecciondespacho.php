<?php

error_reporting(0);

include 'ConexionPGSQL.php';
include 'sesion.class.php';
extract($_REQUEST);
$sesion = new sesion();
$riff = $sesion->get('rif');

$rol = $sesion->get('id_rol_usr');
try {


    $sql = "INSERT INTO tblxian_tpo_entrega (tx_direccion, ci_rif_cliente)  VALUES ('" . $direccion . "', '" . $riff . "') ";
    $result = @pg_query($sql);

    if (!isset($result)) {
        echo "<script language='JavaScript'> alert('No se pudo registrar, verifique') 
                                                              location.href = '../mod_cliente.php'; exit();
                                                                </script> ";
    } else if (isset($result)) {
        echo "<script language='JavaScript'> alert('Registro exitoso') 
                                  location.href = '../mod_cliente.php'; exit();
                                  </script> ";
    }
} catch (Exception $e) {
    $this->SetError($e->getMessage());
    if ($this->exceptions) {
        throw $e;
        echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                        location.href = '../mod-cliente.php'; exit();
                         </script> ";
    }
}
?>

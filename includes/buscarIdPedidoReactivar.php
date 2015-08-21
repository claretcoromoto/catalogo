<?php

include 'sesion.class.php';
include 'ConexionPGSQL.php';


if (isset($_POST['enviar']) ) {
    if (isset($_POST['id_pedido']))
 $remote_addr = $_SERVER['REMOTE_ADDR'];
    try {
        $s = new sesion();
        $rol = $s->get('id_rol_usr');
        $email = $s->get('email');
        $sql = 'SELECT * FROM tblxian_pedido WHERE id_pedido=' . $_POST['id_pedido']. ' AND id_status_pedido = 3';
        $result = @pg_query($sql);

$id_pedido=$_POST['id_pedido'];
        if (pg_num_rows($result) > 0) {
            if (isset($email) && ($rol == 1 )) {
                echo "<script language='JavaScript'> alert('El id de pedido')
                    location.href = '../AdminReactivarPedido.php?ids=$id_pedido ' ;
                              exit();  
                              </script> ";
            }
        } else {
            if (pg_num_rows($result) === 0) {
                if (isset($email) && ($rol == 1)) {
                    echo "<script language='JavaScript'> alert('El id no existe')
                   location.href = '../AdminReactivarPedido.php' ;
                              exit();  
                              </script> ";
                }
            }
        }
    } catch (Exception $e) {
        throw new Exception($e);
    }
} 
?>

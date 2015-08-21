<?php

include 'sesion.class.php';
include 'DaoTercerNivel.php';
$daotercer = new DaoTercerNivel();

$s = new sesion();
$rol = $s->get('id_rol_usr');
$email = $s->get('email');
$idAuto2 = $s->get("id_usr");
$cod=$s->get('cod_repuesto');
error_reporting(0);


$remote_addr = $_SERVER['REMOTE_ADDR'];

if (isset($_POST['enviar'])) {
    extract($_REQUEST);
    try {
        $sqlCate = "SELECT id_categoria, tx_descr_categoria FROM tblxian_categoria WHERE tx_descr_categoria= '" . $nbcategoria . "'  ";
        $resultCate = @pg_query($sqlCate);
        $file = pg_fetch_array($resultCate);

        $rowcate = pg_num_rows($resultCate);
        if ($rowcate < 0) {
            echo "<script language='JavaScript'> alert('La categoria no existe') 
                          location.href = '../AdminActualizarRepuesto.php'; 
                          exit();
                          </script> ";
        }
        $sql = "SELECT cod_repuesto FROM tblxian_repuesto WHERE cod_repuesto='".strtoupper($cod_repuesto)."'";
        $result1 = @pg_query($sql);
        $numrow = pg_num_rows($result1);
        if ($numrow < 0) {
            echo "<script language='JavaScript'> alert('El c\u00f3digo del repuesto') 
                          location.href = '../AdminActualizarRepuesto.php'; 
                          exit();
                          </script> ";
        }
        
        $sqlcat = "SELECT id_categoria, tx_descr_categoria FROM tblxian_categoria WHERE id_categoria=$categoria ";
        $result = @pg_query($sqlcat);
        $file = pg_fetch_array($result);
        $icategoria = $file['id_categoria'];
        if($categoria==''){
            $categoria =$icategoria;
            
        }
   
      echo  $query = "UPDATE tblxian_repuesto SET cod_repuesto='" . $cod_repuesto . "' ,"
              . " tx_descripcion='" . $descripcion . "' ,   nu_precio_contado= $contado,   nu_precio_credito=$credito, 
                                nu_cant_disponible= $cantidad,   id_categoria= $categoria "
              . "      WHERE cod_repuesto='" . $cod_repuesto . "' ";
        $result = @pg_query($query);
        if (isset($result)) {
            $lo->Traza($email, 'Update exitoso de Repuesto. SQL:' . $query . ' IP:' . $remote_addr . ' EMAIL:' . $email . '', 'BD');
            header('Location:../AdminActualizarRepuesto.php?cod_repuesto='.$cod_repuesto.'');
          /*  echo "<script language='JavaScript'> alert('Los datos se han actualizado correctamente')
          location.href = '../AdminBuscarRepuesto.php';
          exit();
          </script> ";*/
        } else {
            $lo->Traza($email, 'Update fallido de Repuesto. SQL:' . $query . ' IP:' . $remote_addr . ' EMAIL:' . $email . '', 'BD');
            echo "<script language='JavaScript'> alert('Los datos no se han actualizado') 
                         location.href = '../AdminBuscarRepuesto.php';  
                          exit();
                          </script> ";
        }
    } catch (Exception $e) {
        throw new Exception($e);
        $lo->Traza($email, 'Update repuesto. IP:' . $remote_addr . ' CATCH:' . $e . '', 'EXCEPTION');
    }
}
?>
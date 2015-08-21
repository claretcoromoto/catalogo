<?php include 'Dao.php';
include 'ConexionPGSQL.php';
extract($_REQUEST);
$remote_addr = $_SERVER['REMOTE_ADDR'];
try {
 
   $sqlCat = "SELECT tx_descr_categoria FROM tblxian_categoria WHERE tx_descr_categoria<>'" . $cat . "'  ";
    $resultCat = @pg_query($sqlCat);
  
    if (!isset($resultCat)) {
             $lo->Traza('Admin', 'SQL:' .  $sqlCat. ' IP:' . $remote_addr . ' ', 'BD');
        echo "<script language='JavaScript'> alert('La categoría existe. Por favor, verifique ') 
                          location.href = '../AdminCategoriaRepuesto.php';
                          exit();
                          </script> ";
    } else {
        $sql = "INSERT INTO tblxian_categoria (tx_descr_categoria, in_activo)  VALUES ('" . strtoupper($cat) . "',1)";
        $result = @pg_query($sql);

        if (!isset($result)) {
               $lo->Traza('Admin', 'SQL fallido:' .  $sql. ' IP:' . $remote_addr . ' ', 'BD');
            echo "<script language='JavaScript'> alert('No se pudo registrar, verifique') 
                                           location.href = '../AdminCategoriaRepuesto.php';  exit();
                                            </script> ";
        } else  {
               $lo->Traza('Admin', 'SQL exitoso:' .  $sqlCat. ' IP:' . $remote_addr . ' ', 'BD');
          
            echo "<script language='JavaScript'> alert('Registro exitoso') 
                                           location.href = '../AdminCategoriaRepuesto.php';  exit();
                                            </script> ";
        }
    
}
}catch (Exception $e) {
    $this->SetError($e->getMessage());
    if ($this->exceptions) {
        throw $e;
        $lo->Traza('Admin', 'Exception.  IP:' . $remote_addr . ' CATCH:' .$e. '', 'EXCEPTION');
        echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                         location.href = '../AdminCategoriaRepuesto.php';  exit();
                         </script> ";
    }
}
?>

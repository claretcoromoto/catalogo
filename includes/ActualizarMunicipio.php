<?php


include 'ConexionPGSQL.php';
extract($_REQUEST);
$remote_addr = $_SERVER['REMOTE_ADDR'];
try {
       $query = "UPDATE tblsit_municipio SET nb_municipio='".$municipio."', id_estado=".$id_estado." "
                . "WHERE id_municipio='" . $id_municipio . "' ";
       $result = @pg_query($query);

        if (!isset($result)) {
             $lo->Traza($email, 'Update fallido municipio. SQL:' . $query . ' IP:' . $remote_addr . ' ', 'BD');
            echo "<script language='JavaScript'> alert('No se pudo actualizar, verifique') 
                                           location.href = '../AdminEditarMunicipio.php'; exit();
                                            </script> ";
        } else {
             $lo->Traza($email, 'Update exitoso municipio. SQL:' . $query . ' IP:' . $remote_addr . ' ', 'BD');
             header('Location:../AdminEditarMunicipio.php');
           
        }
    
} catch (Exception $e) {
    $this->SetError($e->getMessage());
    if ($this->exceptions) {
        throw $e;
          $lo->Traza($email, 'Tipo de exception:' . $$e. ' IP:' . $remote_addr . ' ', 'EXCEPTION');
        echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                       location.href = '../AdminEditarMunicipio.php'; exit();
                         </script> ";
    }
}
?>

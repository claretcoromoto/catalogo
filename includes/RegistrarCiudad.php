<?php

include 'Dao.php';
include 'ConexionPGSQL.php';
extract($_REQUEST);
$remote_addr = $_SERVER['REMOTE_ADDR'];
try {

    $sqlCiudad = "SELECT * FROM tblsit_ciudad WHERE nb_ciudad <>'" . $ciudad . "'  ";
    $resultC = @pg_query($sqlCiudad);

    if (!isset($resultC)) {

        echo "<script language='JavaScript'> alert('La ciudad existe. Por favor, verifique ') 
                        location.href = '../AdminCiudadEditar.php'; 
                          exit();
                          </script> ";
    } else {

        $sql = "INSERT INTO tblsit_ciudad (nb_ciudad, id_municipio)  VALUES ('" . $ciudad . "',$id_municipio) ";
        $result = @pg_query($sql);

        if (!isset($result)) {
            $lo->Traza('Admin', 'Registro ciudad fallido. SQL:' . $sql . ' IP:' . $remote_addr . '', 'BD');
            echo "<script language='JavaScript'> alert('No se pudo registrar, verifique') 
                                          location.href = '../AdminCiudadEditar.php'; exit();
                                            </script> ";
        } else {
            $lo->Traza('Admin', 'Registro ciudad exitoso. SQL:' . $sql . ' IP:' . $remote_addr . '', 'BD');
            echo "<script language='JavaScript'> alert('Registro exitoso') 
                location.href = '../AdminCiudadEditar.php';  exit();
              </script> ";
        }
    }
} catch (Exception $e) {
    $this->SetError($e->getMessage());
    if ($this->exceptions) {
        throw $e;
        $lo->Traza('Admin', 'Registrar ciudad. EXCEPTION:' . $e . ' IP:' . $remote_addr . '', 'EXCEPTION');
        echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                          location.href = '../AdminCiudadEditar.php'; exit();
                         </script> ";
    }
}
?>

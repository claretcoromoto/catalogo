<?php

include 'Dao.php';
include 'ConexionPGSQL.php';
extract($_REQUEST);

try {

    $sqlMunicipio = "SELECT * FROM tblsit_municipio WHERE nb_municipio <>'" . $municipio . "'  ";
    $resultM = @pg_query($sqlMunicipio);

    if (!isset($resultM)) {
        echo "<script language='JavaScript'> alert('El municipio existe. Por favor, verifique ') 
                          location.href = '../AdminEditarMunicipio.php';
                          exit();
                          </script> ";
    } else {

$sql = "INSERT INTO tblsit_municipio ( nb_municipio, id_estado)  VALUES ('" . $municipio. "',$id_estado) ";
        $result = @pg_query($sql);

        if (!isset($result)) {
            echo "<script language='JavaScript'> alert('No se pudo registrar, verifique') 
                                          location.href = '../AdminEditarMunicipio.php'; exit();
                                            </script> ";
        } else {
             echo "<script language='JavaScript'> alert('Registro exitoso') 
              location.href = '../AdminEditarMunicipio.php'; exit();
              </script> "; 
        }
    }
} catch (Exception $e) {
    $this->SetError($e->getMessage());
    if ($this->exceptions) {
        throw $e;
        echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                        location.href = '../AdminMunicipio.php'; exit();
                         </script> ";
    }
}
?>

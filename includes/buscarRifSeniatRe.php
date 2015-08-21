<?php include 'ConexionPGSQL.php';
      include 'Dao.php';

extract($_REQUEST);
$dao = new Dao();
try {
    $sql = " SELECT in_status_cliente FROM tblsit_usr WHERE ci_rif_cliente ='" . strtoupper($rif) . "'  ";
    $result = @pg_query($sql);
    if ($row = pg_num_rows($result) > 0) {
        $file = pg_fetch_array($result);
        $estatus = $file['in_status_cliente'];
        switch ($estatus) {

            case 1 :
                header('Location:../login.php');

                break;
            case 2 :
                echo "<script language='JavaScript'> alert('Pendiente por activar, en 24 horas')                 
                                           location.href = '../index.php';  exit();                                                          
                                        </script> ";
                break;

            case -1 :
                echo "<script language='JavaScript'> alert('Comun\u00edquese con su vendedor de confianza')                 
                                           location.href = '../index.php';  exit();                                                          
                                        </script> ";
                break;
            case -2 :
                echo "<script language='JavaScript'> alert('Comun\u00edquese con su vendedor de confianza')                 
                                           location.href = '../index.php';  exit();                                                          
                                        </script> ";
                break;
            case 0 :
                echo "<script language='JavaScript'> alert('Comun\u00edquese con su vendedor de confianza')                 
                                           location.href = '../index.php';  exit();                                                          
                                        </script> ";
                break;
            default:
                echo "<script language='JavaScript'> alert('Verifique, vuelva a intentarlo')                 
                                           location.href = '../Buscar_Rif.php';  exit();                                                          
                                        </script> ";
                break;
        }
    } else {
        echo "<script language='JavaScript'> //alert('Ud. no est\u00e1 registrado, registrese')                 
                                           location.href = '../Registrar_Clientes.php?rif=$rif'; 
                                               exit();                                                          
                                        </script> ";
    }
} catch (Exception $e) {
    throw new Exception($e);
       $lo->Traza($rif, 'Cliente registrandose. SQL' . $sql, 'Ocurrió exception:   ' . $e);
}
?>

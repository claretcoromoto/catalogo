<?php error_reporting(0);
include 'sesion.class.php';
$s = new sesion();
$rol = $s->get('id_rol_usr');
$email = $s->get('email');
include 'DaoSegNivel.php';
require("jsrsServer.php.inc");

jsrsDispatch("makeEstadoList modelMunicipioList optionsCiudadList");

function makeEstadoList() {
    return serializeSql("SELECT  id_estado, nb_estado FROM tblsit_estado order by nb_estado");
}

function modelMunicipioList($makeEstadoID) {
    return serializeSql("select id_municipio, nb_municipio from tblsit_municipio where id_estado=" . $makeEstadoID . " order by nb_municipio");
}

function optionsCiudadList($modelMunicipioID) {
    return serializeSql("select id_ciudad, nb_ciudad from tblsit_ciudad where id_municipio=" . $modelMunicipioID . " order by nb_ciudad ");
}

function serializeSql($sql) {
    $link = new ConexionPGSQL();
    $link->conexion;

    $result = pg_query($sql);
    $s = '';
    while ($row = pg_fetch_row($result)) {
        $s .= join($row, '~') . "|";
    }

    pg_close($link);
    return $s;
}

extract($_REQUEST);

$sqlusr = "SELECT ci_rif_cliente, tx_login FROM tblsit_usr WHERE tx_login = '" . $correo . "'   OR ci_rif_cliente = '" . strtoupper($rif) . "'  GROUP BY  ci_rif_cliente, tx_login ";
$ru = @pg_query($sqlusr);
//$u = pg_fetch_array($ru);



if ($row = pg_num_rows($ru) > 0) {
    if (isset($email) && $rol == 5) {
        echo "<script language='JavaScript'> alert('El RIF o email existe') 
                         location.href = '../Buscar_Rif_Cliente.php';  exit();
                                                    </script> ";
    }
    if (isset($email) && $rol == 1) {

        echo "<script language='JavaScript'> alert('Usuario registrado') 
                         location.href = '../AdminMenuPrincipal.php';  exit();
                          exit();
                          </script> ";
    } else {
        echo "<script language='JavaScript'> alert('El RIF o el email ya existe') 
                         location.href = '../Buscar_Rif.php';  exit();
                         </script> ";
    }
} else {
    try{
    $daoseg = new DaoSegNivel();
 $remote_addr = $_SERVER['REMOTE_ADDR'];
    $numrow = $daoseg->selectNumRow($correo, $rif);
    if (isset($numrow)) {

        $daoseg = new DaoSegNivel();


        if ($lstOptions == -99) {
            if ($lstOptions == -99) {

                if (isset($correo) && $rol == 5) {
                    echo "<script language='JavaScript'> alert('Por favor, seleccione una ciudad') 
                         location.href = '../catalogo_final.php';  exit();
                                                    </script> ";
                }
                if (isset($email) && $rol == 1) {

                    echo "<script language='JavaScript'> alert('Por favor, seleccione una ciudad') 
                         location.href = '../AdminMenuPrincipal.php';  exit();
                          exit();
                          </script> ";
                }if (!$rol == 5 || !$rol == 1) {

                    echo "<script language='JavaScript'> alert('Por favor, seleccione una ciudad') 
                         location.href = '../login.php';  exit();
                          exit();
                          </script> ";
                } else {
                    echo "<script language='JavaScript'> alert('Por favor, seleccione una ciudad') 
                         location.href = '../Registrar_Clientes.php';  exit();
                         </script> ";
                }
            }
        }

        if (!is_numeric($telefono)) {
            if (isset($email) && $rol == 5) {
                echo "<script language='JavaScript'> alert('Por favor, debe escribir un n\u00famero de tel\u00e9fono v\u00e1lido') 
                         location.href = '../catalogo_final.php';  exit();
                                                    </script> ";
            }
            if (isset($correo) && $rol == 1) {

                echo "<script language='JavaScript'> alert('Por favor, debe escribir un n\u00famero de tel\u00e9fono v\u00e1lido') 
                         location.href = '../AdminMenuPrincipal.php';  exit();
                          exit();
                          </script> ";
            }if (!$rol == 5 || !$rol == 1) {

                echo "<script language='JavaScript'> alert('Por favor, debe escribir un n\u00famero de tel\u00e9fono v\u00e1lido') 
                         location.href = '../login.php';  exit();
                          exit();
                          </script> ";
            } else {
                echo "<script language='JavaScript'> alert('Por favor, debe escribir un n\u00famero de tel\u00e9fono v\u00e1lido') 
                         location.href = '../Registrar_Clientes.php';  exit();
                         </script> ";
            }
        } else {

            include 'getSetPedido.php';
            $asigna = new getSetPedido();
            $autorii = $asigna->asignarautorizadorcle();

            $consulta = $daoseg->insertarCliente($nombre, $empresa, strtoupper($rif), $correo, $password, $preguntaseg, $respuestaseg, $direccion, $lstOptions, $contacto, $telefono, $autorii, $idvenempre);

            if (isset($consulta)) {
                if (isset($email) && $rol == 5) {
                    echo "<script language='JavaScript'> alert('Los datos del cliente se han registrado correctamente') 
                         location.href = '../catalogo_final.php';  exit();
                                                    </script> ";
                }
                if (isset($email) && $rol == 1) {

                    echo "<script language='JavaScript'> alert('Los datos se han registrado correctamente') 
                         location.href = '../AdminMenuPrincipal.php';  exit();
                          exit();
                          </script> ";
                } else if (!$rol == 5 || !$rol == 1) {

                    echo "<script language='JavaScript'> alert('Los datos se han registrado correctamente') 
                         location.href = '../login.php';  exit();
                          exit();
                          </script> ";
                }
            } else {
                if (!isset($consulta)) {
                    echo "<script language='JavaScript'> alert('Los datos no se ha registrado') 
                         location.href = '../login.php';  exit();
                     
                          </script> ";
                }
            }
        }// fin  del else
    } else if (!isset($numrow)) {
        echo "<script language='JavaScript'> alert('El correo electr\u00f3nico y/o RIF  est\u00e1n registrados en nuestro sistema') 
                         location.href = '../login.php';  exit();
                     
                          </script> ";
    }
    
    
    
    } catch (Exception $e) {
    $this->SetError($e->getMessage());
    if ($this->exceptions) {
        throw $e;
        $lo->Traza($email, 'Exception.  IP:' . $remote_addr . ' CATCH:' . $e . '   SQL: ' . $sql . '', 'EXCEPTION');
    }
}
}


?>

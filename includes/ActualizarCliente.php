<?php
require_once "sesion.class.php";
$sesion = new sesion();

$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
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

if (isset($_POST['submit'])) {
    $nombre = trim(htmlentities(strip_tags($_POST['nombre'])));
    $rif = strtoupper(trim(htmlentities(strip_tags($_POST['rif']))));
    $direccion = trim(htmlentities(strip_tags($_POST['direccion'])));
    $contacto = trim(htmlentities(strip_tags($_POST['contacto'])));
    $telefono = trim(htmlentities(strip_tags($_POST['telefono'])));
    $id_ciudad = ($_POST['lstOptions']);
    $remote_addr = $_SERVER['REMOTE_ADDR'];
    if (isset($nombre) && isset($rif) && isset($direccion) && isset($contacto) && isset($telefono)) {
        $id_ciudad = $_POST['lstOptions'];
        if ($id_ciudad == -99 || !is_numeric($telefono)) {
            if ($id_ciudad == -99) {
                echo "<script language='JavaScript'> alert('Por favor, debe seleccionar una ciudad') 
                         location.href = '../Actualizar_Clientes.php';  exit();
                       </script> ";
            }
            if (!is_numeric($_POST['telefono'])) {
                echo "<script language='JavaScript'> alert('Por favor, debe escribir un número de tel\u00e9fono v\u00e1lido') 
                          exit();
                          </script> ";
            }
        } else
            $nombre = trim(htmlentities(strip_tags($_POST['nombre'])));
        $rif = strtoupper(trim(htmlentities(strip_tags($_POST['rif']))));
        $direccion = trim(htmlentities(strip_tags($_POST['direccion'])));
        $contacto = trim(htmlentities(strip_tags($_POST['contacto'])));
        $telefono = trim(htmlentities(strip_tags($_POST['telefono'])));
        $id_ciudad = ($_POST['lstOptions']);
        try {
            $dao_update = new DaoSegNivel(); //actualizarCliente($rif, $nombre, $direccion, $id_ciudad, $contacto, $telefono);
            $result = $dao_update->actualizarCliente($rif, $nombre, $direccion, $id_ciudad, $contacto, $telefono);
            if (!isset($result)) {
                $lo->Traza($email, 'Update usuario fallido.  IP:' . $remote_addr . ' RIF cliente:' . $rif . '', 'BD');

                echo "<script language='JavaScript'> alert('No se pudo actualizar, verifique') 
                          location.href = '../Actualizar_Clientes.php';  exit();
                            </script> ";
            } else if (isset($result)) {
                $lo->Traza($email, 'Update usuario fallido.  IP:' . $remote_addr . ' RIF cliente:' . $rif . '', 'BD');
                echo "<script language='JavaScript'> alert('Actualizaci\u00f3n exitosa') 
                          location.href = '../index.php';  exit();
                            </script> ";
            }
        } catch (Exception $e) {
            throw new Exception($e);
            $lo->Traza($email, 'Update cliente exception. EXCEPTION:' . $e . '   IP:' . $remote_addr . ' RIF cliente:' . $rif . '', 'BD');
        }
    } else {
        echo "<script language='JavaScript'> alert('Verifique los campos') 
                          location.href = '../Actualizar_Clientes.php';  exit();
                            </script> ";
    }
} else {
    echo "<script language='JavaScript'> alert('Comun\u00edquese con el administrador del sistema') 
                          location.href = '../index.php';  exit();
                            </script> ";
}
?>

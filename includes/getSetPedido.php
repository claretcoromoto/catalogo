<?php

error_reporting(E_ALL ^ E_NOTICE);

class getSetPedido {

    function __construct() {
        ;
    }

    function buscarestado() {
        $query = @pg_query("SELECT * FROM tblsit_estado   ORDER BY nb_estado ASC");
        $estado = '';
        while ($row = pg_fetch_array($query)) {
            $estado .=" <option value=" . $row['id_estado'] . "> " . $row['nb_estado'] . "</option>";
        }
        return $estado;
    }

    function buscarmunicipio() {
        $query = @pg_query("SELECT * FROM tblsit_municipio  ORDER BY nb_municipio ASC");
        $municipio = '';
        while ($row = pg_fetch_array($query)) {
            $municipio .=" <option value=" . $row['id_estado'] . "> " . $row['nb_municipio'] . "</option>";
        }
        return $municipio;
    }

    function buscarciudad() {
        $query = @pg_query("SELECT * FROM tblsit_ciudad ORDER BY nb_ciudad ASC");
        $ciudad = '';

        while ($row = pg_fetch_array($query)) {
            $ciudad .=" <option value=" . $row['id_municipio'] . "> " . $row['nb_ciudad'] . "</option>";
        }
        return $ciudad;
    }

    function buscaridciudad() {
        $query = @pg_query("SELECT * FROM tblsit_ciudad");
        $row = pg_fetch_array($query);
        if (isset($row)) {
            return $row['id_ciudad'];
        }
    }

    function buscarIdPedido() {
        $sql = "SELECT id_pedido FROM tblxian_pedido ";
        //  echo $sql;
        $result = @pg_query($sql);
        $row = pg_fetch_array($result);
        if ($row == true) {
            return $row['id_pedido'];
        } else {
            return false;
        }
    }

    function getIdSolo($email) {

        $sql = "SELECT id_usr
                 FROM   tblsit_usr
                 WHERE  tx_login=  '" . $email . "'";

        $result = @pg_query($sql);
        $row = pg_fetch_array($result);
        if ($row == true) {
            return $row['id_usr'];
        } else {
            return false;
        }
    }

    function getIdCliente($email, $id) {

        $sql = "SELECT ci_rif_cliente FROM   tblsit_usr
                   WHERE  tx_login=  '" . $email . "'
                   AND    id_usr= " . $id . " ";
        $result = @pg_query($sql);
        $row = pg_num_rows($result);
        $file = pg_fetch_array($result);
        if ($row > 0) {
            return $file['ci_rif_cliente'];
        } else {
            return false;
        }
    }

    function getIdVendedor($email, $rol) {

        $sql = "SELECT id_usr, id_rol_usr
                 FROM   tblsit_usr
                 WHERE  tx_login=  '" . $email . "'
                 AND    id_rol_usr=" . $rol . "";
        $result = @pg_query($sql);
        $row = pg_fetch_array($result);
        if (isset($row)) {
            return $row['id_usr'];
        } else {
            return false;
        }
    }

    function mostrarRifClientesaVendedores($idVendedor) {

        $sql = "SELECT * FROM tblsit_usr WHERE id_rol_usr= 5 AND id_usr=" . $idVendedor . " ";
        $result = pg_query($sql);
        $comborif = '';

        while ($row = pg_fetch_array($result)) {
            $comborif .=" <option value=" . $row['ci_rif_cliente'] . "> " . $row['ci_rif_cliente'] . "</option>";
        }
        return $comborif;
    }

    function buscarCountDisponible() {
        $sql = "SELECT  
              COUNT(id_usr_autor_vta),
              id_usr_autor_vta
              FROM tblxian_pedido
              WHERE id_status_pedido= 1
              GROUP BY  id_usr_autor_vta
              ORDER BY  COUNT(id_usr_autor_vta) ASC";
        $result = pg_query($sql);
        $row = pg_fetch_array($result);
        if ($row = pg_fetch_array($result)) {
            return $row['id_usr_autor_vta'];
        } else {
            return false;
        }
    }

    function asignarautorizadorvta() {

        $sql = "SELECT  
              COUNT (id_usr) AS contar
              FROM tblsit_usr
              WHERE id_rol_usr= 3 
			  AND in_status_usr=1";

        $result = @pg_query($sql);
        $row = pg_fetch_array($result);
        if ($row['contar'] === 0) {
            return 0;
        } else {
            if ($row['contar'] === 1) {
                $sql = "SELECT  
              id_usr
              FROM tblsit_usr
              WHERE id_rol_usr= 3 
	      AND in_status_usr=1";

                $result = @pg_query($sql);
                $row = pg_fetch_array($result);
                return $row['id_usr'];
            } else {
                $i = 0;
                $arrayId = array();
                $conrow = $row['contar'];
                $sql = "SELECT  
              id_usr
              FROM tblsit_usr
              WHERE id_rol_usr= 3 
			  AND in_status_usr=1";
                $result = @pg_query($sql);

                while ($row = pg_fetch_array($result)) {
                    $arrayId[$i] = $row['id_usr'];
                    $i++;
                }
                $menor = 0;
                $carga = 0;
                for ($index = 0; $index < $i; $index++) {
                    $sql = "SELECT  
              COUNT(id_pedido) AS contarpedido
              FROM tblxian_pedido
              WHERE id_status_pedido= 1
              AND id_usr_autor_vta= " . $arrayId[$index] . "
              ";
                    $result = pg_query($sql);
                    $row = pg_fetch_array($result);
                    if ($index === 0) {
                        $menor = $arrayId[$index];
                        $carga = $row['contarpedido'];
                    } else {
                        if ($carga > $row['contarpedido']) {
                            $menor = $arrayId[$index];
                            $carga = $row['contarpedido'];
                        }
                    }
                }//fin de for
                return $menor;
            }
        }
    }

    function asignarautorizadorcle() {

        $sql = "SELECT COUNT (id_usr) AS contar FROM tblsit_usr WHERE id_rol_usr= 2 AND in_status_usr=1";

        $result = @pg_query($sql);
        $row = pg_fetch_array($result);
        if ($row['contar'] === 0) {
            return 0;
        } else {
            if ($row['contar'] === 1) {
                $sql = "SELECT id_usr FROM tblsit_usr WHERE id_rol_usr= 2  AND in_status_usr=1";

                $result = @pg_query($sql);
                $row = pg_fetch_array($result);
                return $row['id_usr'];
            } else {
                $i = 0;
                $arrayId = array();
                $conrow = $row['contar'];
                $sql = "SELECT id_usr FROM tblsit_usr WHERE id_rol_usr= 2 AND in_status_usr=1";
                $result = @pg_query($sql);

                while ($row = pg_fetch_array($result)) {
                    $arrayId[$i] = $row['id_usr'];
                    $i++;
                }
                $menor = 0;
                $carga = 0;
                for ($index = 0; $index < $i; $index++) {
                    $sql = "SELECT COUNT(id_usr) AS contarusuario FROM tblsit_usr WHERE in_status_cliente= 1 AND id_usr_autor_clte= " . $arrayId[$index] . " ";
                    $result = pg_query($sql);
                    $row = pg_fetch_array($result);
                    if ($index === 0) {
                        $menor = $arrayId[$index];
                        $carga = $row['contarusuario'];
                    } else {
                        if ($carga > $row['contarusuario']) {
                            $menor = $arrayId[$index];
                            $carga = $row['contarusuario'];
                        }
                    }
                }//fin de for
                return $menor;
            }
        }
    }

    function asignarvendedorcle() {
// aquì valido si es igual a cero para retornar cero
     echo  $sql = "SELECT COUNT (id_usr) AS contar FROM tblsit_usr WHERE id_rol_usr= 5 AND in_status_usr=1";

        $result = @pg_query($sql);
        $row = pg_fetch_array($result);
        if ($row['contar'] === 0) {
            return 0;
        } else {  //de lo contrario valido si es Uno y retorno Uno, es decir, retorno el único  id_usr disponible
            if ($row['contar'] === 1) {
                $sql = "SELECT id_usr FROM tblsit_usr WHERE id_rol_usr= 5  AND in_status_usr=1";

                $result = @pg_query($sql);
                $row = pg_fetch_array($result);
                return $row['id_usr'];
            } else { // si es mayor a UNO;  
                $i = 0;
                $arrayId = array();
                $conrow = $row['contar'];
                $sql = "SELECT id_usr FROM tblsit_usr WHERE id_rol_usr= 5 AND in_status_usr=1";
                $result = @pg_query($sql);

                while ($row = pg_fetch_array($result)) {
                    $arrayId[$i] = $row['id_usr'];
                    $i++;
                }
                $menor = 0;
                $carga = 0;
                for ($index = 0; $index < $i; $index++) {
                    $sql = "SELECT COUNT(id_usr) AS contarusuario FROM tblsit_usr WHERE in_status_cliente= 1 AND id_usr_vendedor= " . $arrayId[$index] . " ";
                    $result = pg_query($sql);
                    $row = pg_fetch_array($result);
                    if ($index === 0) {
                        $menor = $arrayId[$index];
                        $carga = $row['contarusuario'];
                    } else {
                        if ($carga > $row['contarusuario']) {
                            $menor = $arrayId[$index];
                            $carga = $row['contarusuario'];
                        }
                    }
                }//fin de for
                return $menor;
            }
        }
    }
///////////////////////////////////////////   V E N D E D O R  ////////////////////////////////////////////////////
   
    function leerCerov() {

        $sql = "SELECT COUNT (id_usr) AS contar FROM tblsit_usr WHERE id_rol_usr= 5 AND in_status_usr=1";

        $result = @pg_query($sql);
        $row = pg_fetch_array($result);
        if ($row['contar'] === 0) {
            return 0;
        }
    }
    
    
    
    
    
    function leerUnov() {
    if (leerCero() === 1) {
                $sql = "SELECT id_usr FROM tblsit_usr WHERE id_rol_usr= 5  AND in_status_usr=1";

                $result = @pg_query($sql);
                $row = pg_fetch_array($result);
                return $row['id_usr'];
    }
    
    }
    
        function leerArrayMenor() {
          if(leerUno() >1){
            $i = 0;
                $arrayId = array();
                $conrow = $row['contar'];
                $sql = "SELECT id_usr FROM tblsit_usr WHERE id_rol_usr= 5 AND in_status_usr=1";
                $result = @pg_query($sql);

                while ($row = pg_fetch_array($result)) {
                    $arrayId[$i] = $row['id_usr'];
                    $i++;
                }
                $menor = 0;
                $carga = 0;
                for ($index = 0; $index < $i; $index++) {
                    $sql = "SELECT COUNT(id_usr) AS contarusuario FROM tblsit_usr WHERE in_status_cliente= 1 AND id_usr_vendedor= " . $arrayId[$index] . " ";
                    $result = pg_query($sql);
                    $row = pg_fetch_array($result);
                    if ($index === 0) {
                        $menor = $arrayId[$index];
                        $carga = $row['contarusuario'];
                    } else {
                        if ($carga > $row['contarusuario']) {
                            $menor = $arrayId[$index];
                            $carga = $row['contarusuario'];
                        }
                    }
                }//fin de for
                return $menor;
            
            
        }
        }
        
        function leerArrayMayor() {
    
            $i = 0;
                $arrayId = array();
                $conrow = $row['contar'];
                $sql = "SELECT id_usr FROM tblsit_usr WHERE id_rol_usr= 5 AND in_status_usr=1";
                $result = @pg_query($sql);

                while ($row = pg_fetch_array($result)) {
                    $arrayId[$i] = $row['id_usr'];
                    $i++;
                }
                $menor = 0;
                $carga = 0;
                for ($index = 0; $index < $i; $index++) {
                    $sql = "SELECT COUNT(id_usr) AS contarusuario FROM tblsit_usr WHERE in_status_cliente= 1 AND id_usr_vendedor= " . $arrayId[$index] . " ";
                    $result = pg_query($sql);
                    $row = pg_fetch_array($result);
                    if ($index === 0) {
                        $menor = $arrayId[$index];
                        $carga = $row['contarusuario'];
                    } else {
                        if ($carga > $row['contarusuario']) {
                            $menor = $arrayId[$index];
                            $carga = $row['contarusuario'];
                        }
                    }
                }//fin de for
                return $carga;
            
            
        }
//////////////////////////////////////////////////////////////////////////////////////
    function getAutoriPrimeraVez() {
        $sql = "SELECT id_usr 
                   FROM   tblsit_usr
                   WHERE  id_rol_usr= 3";
        $result = @pg_query($sql);
        $row = pg_fetch_array($result);
        if ($row == true) {
            return $row['id_usr'];
        } else {
            return false;
        }
    }

    function buscarentrega() {

        $sql = "SELECT * FROM tblxian_tpo_entrega   ";
        $result = pg_query($sql);
        $combobit = '';
        while ($row = pg_fetch_array($result)) {  //<select name="nombre" OnFocus="toma_seleccion(this)" 
//OnChange="pon_seleccion(this)">
            $combobit .=" <option   value=" . $row['nb_tpo_entrega'] . "> " . $row['nb_tpo_entrega'] . "</option>";
        }
        return $combobit;
    }

    function buscarentregaRegistrada($rif) {

        $sql = "SELECT * FROM tblxian_tpo_entrega WHERE ci_rif_cliente='" . $rif . "'  ";
        $result = pg_query($sql);
        $comboDir = '';
        while ($row = pg_fetch_array($result)) {
            $comboDir .=" <option   value=" . $row['tx_direccion'] . "> " . $row['tx_direccion'] . "</option>";
        }
        return $comboDir;
    }

    function inbsertarDetallesPedido($cod_repuesto, $nuPrecio, $inCant, $idPedido) {
        $sql = "INSERT INTO tblxian_detalle_pedido (cod_repuesto, nu_precio,in_cantidad, id_pedido)
              VALUES ('" . $cod_repuesto . "', " . $nuPrecio . ", " . $inCant . ", " . $idPedido . ")";
        $insertado = pg_query($sql);
        if (isset($insertado)) {
            return true;
        } else {
            return false;
        }
    }

    function consultardetallespedidos($idetalle) {

        $sql = "SELECT * FROM tblxian_detalle_pedido WHERE id_detalle_pedido=" . $idetalle . "";
        $result = pg_query($sql);
        $row = pg_fetch_array($result);
        if ($row == true) {
            return $row;
        } else {
            return false;
        }
    }

    function getStatus() {

        $sql = "SELECT id_status_pedido FROM tblxian_status_pedido WHERE id_status_pedido=1 LIMIT 1";
        $result = pg_query($sql);
        $row = pg_fetch_array($result);
        if ($row == true) {
            return $row['id_status_pedido'];
        } else {
            return false;
        }
    }

    function tipoentrega($nbentrega) {

        $sql = "SELECT id_tpo_entrega FROM tblxian_tpo_entrega  WHERE  nb_tpo_entrega= '" . $nbentrega . "'";
        $result = @pg_query($sql);
        $row = pg_fetch_array($result);
        if ($row == true) {
            return $row['id_tpo_entrega '];
        } else {
            return false;
        }
    }

    function buscarnombretipoentrega() {

        $sql = "SELECT nb_tpo_entrega FROM tblxian_tpo_entrega WHERE id_tpo_entrega= 1 AND id_tpo_entrega= 2 ";
        $result = @pg_query($sql);
        $row = pg_fetch_array($result);
        if ($row == true) {
            return $row;
        } else {
            return false;
        }
    }

    function buscarRifSeniat($rif) {
        $sql = "SELECT
     tblsit_usr.id_usr AS tblsit_usr_id_usr,
     tblsit_usr.razon_social_cliente AS tblsit_usr_razon_social_cliente,
     tblsit_usr.ci_rif_cliente AS tblsit_usr_ci_rif_cliente,
     tblsit_usr.id_rol_usr AS tblsit_usr_id_rol_usr,
     tblsit_usr.in_status_usr AS tblsit_usr_in_status_usr,
     tblsit_usr.in_status_cliente AS tblsit_usr_in_status_cliente,
     tblsit_rol_usr.id_rol_usr AS tblsit_rol_usr_id_rol_usr,
     tblsit_rol_usr.nb_rol_usr AS tblsit_rol_usr_nb_rol_usr,
     tblsit_rol_usr.int_activo AS tblsit_rol_usr_int_activo
FROM
     tblsit_rol_usr tblsit_rol_usr INNER JOIN tblsit_usr tblsit_usr ON tblsit_rol_usr.id_rol_usr = tblsit_usr.id_rol_usr
WHERE tblsit_usr.ci_rif_cliente='" . $rif . "'

";

        $result = @pg_query($sql);
        if (isset($result)) {
            echo $result;
        } else {
            echo "<script language='JavaScript'> alert('El Rif no está registrado en nuestra base de datos ) 
                          location.href = '/../catalogo_final.php';
                          exit();
                          </script> ";
        }
    }

    function buscarRif($rif) {
        $sql = "SELECT ci_rif_cliente FROM tblsit_usr WHERE ci_rif_cliente= '" . $rif . "'";


        //  echo $sql;
        $result = @pg_query($sql);
        $row = pg_fetch_array($result);
        if ($row['ci_rif_cliente'] == $rif) {
            echo $row['ci_rif_cliente'];
        } else {
            echo "<script language='JavaScript'> alert('El Rif no está registrado en nuestra base de datos' ) 
                          location.href = '/../catalogo_final.php';
                          exit();
                          </script> ";
        }
    }

    function buscarrifenelpedido() {
        $sql = "SELECT ci_rif_cliente FROM tblxian_pedido WHERE id_usr= " . $idusr . " AND id_autor_vta =" . $idusr . " ";
        //  echo $sql;
        $result = @pg_query($sql);
        $row = pg_fetch_array($result);
        if ($row == true) {
            return $row['ci_rif_cliente'];
        } else {
            return false;
        }
    }

    function contadocredito($idpedido) {
        $sql = "SELECT tx_forma_pago FROM tblxian_pedido WHERE id_pedido= " . $idpedido . " ";
        //  echo $sql;
        $result = pg_query($sql);
        $row = pg_fetch_array($result);
        if (isset($row)) {
            return $row;
        } else {
            return false;
        }
    }

}

?>

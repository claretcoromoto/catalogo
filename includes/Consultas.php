<?php

class Consultas {

    
    
    
    function vendedorMas(){
        
         $i = 0;
                $arrayId = array();
                $conrow = $row['contar'];
                $sql = "SELECT id_usr FROM tblsit_usr WHERE id_rol_usr= 5 AND in_status_usr=1";
                $result = @pg_query($sql);

                while ($row = pg_fetch_array($result)) {
                    $arrayId[$i] = $row['id_usr'];
                    $i++;
                }
                $mayor = 0;
                $carga = 0;
                for ($index = 0; $index < $i; $index++) {
                    $sql = "SELECT COUNT(id_usr) AS contarusuario FROM tblsit_usr WHERE in_status_cliente= 1 AND id_usr_vendedor= " . $arrayId[$index] . " ";
                    $result = pg_query($sql);
                    $row = pg_fetch_array($result);
                    if ($index === 0) {
                        $mayor = $arrayId[$index];
                        $carga = $row['contarusuario'];
                    } else {
                        if ($carga <$row['contarusuario']) {
                            $mayor = $arrayId[$index];
                            $carga = $row['contarusuario'];
                        }
                    }
                }//fin de for
                return $mayor;
    }
           function vendedorMenor(){
        
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
    
    function vendedorMod(){
        
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
                        if ($carga == $row['contarusuario']) {
                            $menor = $arrayId[$index];
                            $carga = $row['contarusuario'];
                        }
                    }
                }//fin de for
                return $carga;
    } 
    
    function __construct() {
        ;
    }

    function estado() {
        return pg_query("SELECT * FROM tblsit_estado");
    }

    function municipio() {

        return pg_query("SELECT * FROM tblsit_municipio");
    }

    function ciudad() {

        return pg_query("SELECT * FROM tblsit_ciudad");
    }

    function consultarrifenbasededatos($rifseniat) {

        return @pg_query("SELECT  tblsit_usr.id_usr AS tblsit_usr_id_usr,tblsit_usr.razon_social_cliente AS tblsit_usr_razon_social_cliente,
                        tblsit_usr.ci_rif_cliente AS tblsit_usr_ci_rif_cliente, tblsit_usr.id_rol_usr AS tblsit_usr_id_rol_usr,
                        tblsit_usr.in_status_usr AS tblsit_usr_in_status_usr, tblsit_usr.in_status_cliente AS tblsit_usr_in_status_cliente,
                        tblsit_rol_usr.id_rol_usr AS tblsit_rol_usr_id_rol_usr, tblsit_rol_usr.nb_rol_usr AS tblsit_rol_usr_nb_rol_usr,
                        tblsit_rol_usr.int_activo AS tblsit_rol_usr_int_activo
               FROM     tblsit_rol_usr
               tblsit_rol_usr INNER JOIN tblsit_usr 
               tblsit_usr ON tblsit_rol_usr.id_rol_usr = tblsit_usr.id_rol_usr
               WHERE tblsit_usr.ci_rif_cliente='" . $rifseniat . "' ");
    }

    
    
    function consultarIdCiudad($id_autorii){
        
        $sql="SELECT tblsit_usr.razon_social_cliente AS tblsit_usr_razon_social_cliente,
tblsit_usr.ci_rif_cliente AS tblsit_usr_ci_rif_cliente,
               tblsit_usr.tx_direccion AS tblsit_usr_tx_direccion,
               tblsit_usr.nb_persona_contacto AS tblsit_usr_nb_persona_contacto,
               tblsit_usr.tx_telf_contacto AS tblsit_usr_tx_telf_contacto,
               tblsit_usr.tx_login AS tblsit_usr_tx_login,
               tblsit_ciudad.nb_ciudad AS tblsit_ciudad_nb_ciudad,
               tblsit_municipio.nb_municipio AS tblsit_municipio_nb_municipio,
               tblsit_estado.nb_estado AS tblsit_estado_nb_estado,
               tblsit_usr.in_status_cliente AS tblsit_usr_in_estatus_cliente
                FROM tblsit_ciudad tblsit_ciudad 
                INNER JOIN tblsit_usr tblsit_usr ON tblsit_ciudad.id_ciudad = tblsit_usr.id_ciudad
                INNER JOIN tblsit_municipio tblsit_municipio 
                ON tblsit_ciudad.id_municipio = tblsit_municipio.id_municipio
                INNER JOIN tblsit_estado tblsit_estado ON tblsit_municipio.id_estado = tblsit_estado.id_estado
                 WHERE tblsit_usr.id_rol_usr = 4 AND (tblsit_usr.in_status_cliente = 2 OR tblsit_usr.in_status_cliente = -2) AND id_usr_autor_clte='$idAutorii'";
        $query= @pg_query($sql);
        $file=pg_fetch_array($query);
           return  $file;
    }
    /*
      function consultarrif($idusr, $rif, $id_pedido) {

      return pg_query("
      SELECT U.razon_social_cliente,
      R.id_rol_usr,
      P.id_pedido, P.fe_registro, P.ci_rif_cliente, P.tx_direccion_entrega, P.tx_forma_pago, P.nu_sub_total,
      D.cod_repuesto, nu_precio, in_cantidad,
      E.nb_tpo_entrega,
      S.nb_status_pedido,
      Re.tx_descripcion
      FROM
      tblxian_status_pedido S
      INNER JOIN tblxian_pedido P
      ON          ( S.id_status_pedido =  P.id_status_pedido )
      INNER JOIN tblxian_tpo_entrega E
      ON       ( P.id_tpo_entrega =  E.id_tpo_entrega)
      INNER JOIN tblxian_detalle_pedido D
      ON       ( P.id_pedido = D.id_pedido)
      INNER JOIN   tblsit_usr U
      ON       ( P.id_usr = U.id_usr)
      INNER JOIN   tblsit_rol_usr R
      ON       ( U.id_rol_usr = R.id_rol_usr)
      INNER JOIN tblxian_repuesto Re
      ON          ( D.cod_repuesto = Re.cod_repuesto )
      WHERE  P.id_pedido=".$id_pedido."
      AND  P.id_usr=".$idusr."
      AND P.ci_rif_cliente='".$rif."'
      GROUP BY
      U.razon_social_cliente,
      R.id_rol_usr,
      P.id_pedido, P.fe_registro, P.ci_rif_cliente, P.tx_direccion_entrega,   P.tx_forma_pago, P.nu_sub_total,
      D.id_detalle_pedido, D.cod_repuesto,
      E.nb_tpo_entrega,
      S.id_status_pedido, S.nb_status_pedido, Re.tx_descripcion
      ORDER BY  P.id_pedido DESC
      ");
      }
     */

    function consultarusr($idusr) {

        return pg_query("
   select p.id_usr, p.id_pedido, p.fe_registro, p.tx_forma_pago, p.ci_rif_cliente, p.tx_direccion_entrega,
 sp.nb_status_pedido, te.nb_tpo_entrega
from tblxian_pedido p, tblsit_usr u, tblxian_status_pedido sp, tblxian_tpo_entrega te
where u.id_usr =" . $idusr . "
    and p.id_status_pedido = sp.id_status_pedido
and te.id_tpo_entrega = p.id_tpo_entrega
order by p.id_pedido desc
");
    }

    function consultarrif($idusr, $rif) {

        return pg_query("
   select p.id_usr, p.id_pedido, p.fe_registro, p.tx_forma_pago, p.ci_rif_cliente, p.tx_direccion_entrega,
 sp.nb_status_pedido, te.nb_tpo_entrega
from tblxian_pedido p, tblsit_usr u, tblxian_status_pedido sp, tblxian_tpo_entrega te
where u.id_usr =" . $idusr . "

and  p.ci_rif_cliente =  '" . strtoupper($rif) . "'
    and p.id_status_pedido = sp.id_status_pedido
and te.id_tpo_entrega = p.id_tpo_entrega
order by p.id_pedido desc
");
    }

    function consultaridrif($idusr, $idpedido) {

        return pg_query("
   select p.id_usr, p.id_pedido, p.fe_registro, p.tx_forma_pago, p.ci_rif_cliente, p.tx_direccion_entrega,
 sp.nb_status_pedido, te.nb_tpo_entrega
from tblxian_pedido p, tblsit_usr u, tblxian_status_pedido sp, tblxian_tpo_entrega te
where u.id_usr =" . $idusr . "
    
    and  p.id_pedido =  " . $idpedido . "
    and p.id_status_pedido = sp.id_status_pedido
    and te.id_tpo_entrega = p.id_tpo_entrega
order by p.id_pedido desc
");
    }

    function consultaridrifcli($idusr, $idpedido, $rif) {

        return pg_query("
   select p.id_usr, p.id_pedido, p.fe_registro, p.tx_forma_pago, p.ci_rif_cliente, p.tx_direccion_entrega,
 sp.nb_status_pedido, te.nb_tpo_entrega
from tblxian_pedido p, tblsit_usr u, tblxian_status_pedido sp, tblxian_tpo_entrega te
where u.id_usr =" . $idusr . "
    and  p.ci_rif_cliente='" . strtoupper($rif) . "'
    and  p.id_pedido =  " . $idpedido . "
    and p.id_status_pedido = sp.id_status_pedido
    and te.id_tpo_entrega = p.id_tpo_entrega
order by p.id_pedido desc
");
    }

    function consultarfe($idusr, $fecha1, $fecha2) {
        $fecha11 = date("Y-m-d", strtotime($fecha1));
        $fecha22 = date("Y-m-d", strtotime($fecha2));
        return pg_query("
   select p.id_usr, p.id_pedido, p.fe_registro, p.tx_forma_pago, p.ci_rif_cliente, p.tx_direccion_entrega,
 sp.nb_status_pedido, te.nb_tpo_entrega
from tblxian_pedido p, tblsit_usr u, tblxian_status_pedido sp, tblxian_tpo_entrega te
where u.id_usr =" . $idusr . "
AND p.fe_registro  BETWEEN  '" . $fecha11 . "' AND
   '" . $fecha22 . "'
AND p.id_status_pedido = sp.id_status_pedido
 AND te.id_tpo_entrega = p.id_tpo_entrega
order by p.id_pedido desc
");
    }

    function consultarfecli($idusr, $rif, $fecha1, $fecha2) {
        $fecha11 = date("Y-m-d", strtotime($fecha1));
        $fecha22 = date("Y-m-d", strtotime($fecha2));
        return pg_query("
   select p.id_usr, p.id_pedido, p.fe_registro, p.tx_forma_pago, p.ci_rif_cliente, p.tx_direccion_entrega,
 sp.nb_status_pedido, te.nb_tpo_entrega
from tblxian_pedido p, tblsit_usr u, tblxian_status_pedido sp, tblxian_tpo_entrega te
where u.id_usr = " . $idusr . "
    AND p.ci_rif_cliente ='" . strtoupper($rif) . "'
   AND p.fe_registro  BETWEEN  '" . $fecha11 . "' AND
   '" . $fecha22 . "'
    AND p.id_status_pedido = sp.id_status_pedido
 AND te.id_tpo_entrega = p.id_tpo_entrega
order by p.id_pedido desc
");
    }

    function consultarestatus($idusr, $status) {

        return pg_query("
   select p.id_usr, 
   p.id_pedido,
   p.fe_registro,
   p.tx_forma_pago,
   p.ci_rif_cliente,
   p.tx_direccion_entrega,
p.id_status_pedido,
sp.nb_status_pedido,

sp.id_status_pedido,
te.nb_tpo_entrega
from tblxian_pedido p, tblsit_usr u, tblxian_status_pedido sp, tblxian_tpo_entrega te
where u.id_usr =" . $idusr . "
    and sp.nb_status_pedido = '" . $status . "'
        and p.id_status_pedido= sp.id_status_pedido
and te.id_tpo_entrega = p.id_tpo_entrega
order by p.id_pedido desc
");
    }

    function consultarestatuscli($idusr, $status, $rif) {

        return pg_query("
   select p.id_usr, 
   p.id_pedido,
   p.fe_registro,
   p.tx_forma_pago,
   p.ci_rif_cliente,
   p.tx_direccion_entrega,
p.id_status_pedido,
sp.nb_status_pedido,

sp.id_status_pedido,
te.nb_tpo_entrega
from tblxian_pedido p, tblsit_usr u, tblxian_status_pedido sp, tblxian_tpo_entrega te
where u.id_usr =" . $idusr . "
    and  p.ci_rif_cliente='" . strtoupper($rif) . "'
    and sp.nb_status_pedido = '" . $status . "'
        and p.id_status_pedido= sp.id_status_pedido
and te.id_tpo_entrega = p.id_tpo_entrega
order by p.id_pedido desc
");
    }

    function consultarporfacturapedido($id_pedido, $rif) {
        return $sql = pg_query("SELECT DISTINCT
    tblxian_pedido.id_pedido, 
  tblxian_pedido.ci_rif_cliente AS ci_rif_cliente, 
  tblxian_detalle_pedido.cod_repuesto AS cod_repuesto , 
  tblxian_detalle_pedido.nu_precio AS nu_precio, 
  tblxian_detalle_pedido.in_cantidad AS in_cantidad,
  tblxian_detalle_pedido.id_pedido  AS id_pedido_detalle, 
  tblxian_pedido.tx_direccion_entrega AS tx_direccion_entrega, 
  tblxian_pedido.fe_registro AS fe_registro, 
  tblxian_pedido.id_usr AS id_usr
FROM 
 
  public.tblxian_detalle_pedido, 
  public.tblxian_pedido

  WHERE tblxian_pedido.ci_rif_cliente='" . strtoupper($rif) . "'
  AND    tblxian_pedido.id_pedido =" . $id_pedido . " 

GROUP BY

  tblxian_pedido.tx_forma_pago,
  tblxian_pedido.tx_direccion_entrega, 

  tblxian_pedido.id_usr_autor_vta, 
  ci_rif_cliente, 
  fe_registro, 
  id_usr, 
tblxian_pedido.id_pedido, 
  tblxian_detalle_pedido.id_pedido, 
  in_cantidad, 
  nu_precio, 
  cod_repuesto, 

  tblxian_detalle_pedido.id_detalle_pedido= tblxian_pedido.id_pedido

HAVING tblxian_detalle_pedido.id_pedido =  tblxian_pedido.id_pedido 
");
    }

    function insertarPedido($idsr, $fecharegistro, $rif, $idautorii, $entrega, $direccion, $idstatus, $formpago, $sub) {
        return pg_query("INSERT INTO tblxian_pedido (
                                                    id_usr, 
                                                    fe_registro,
                                                    ci_rif_cliente,
                                                    id_usr_autor_vta,
                                                    id_tpo_entrega,
                                                    tx_direccion_entrega,
                                                    id_status_pedido,
                                                    tx_forma_pago, 
                                                    nu_sub_total )
                                VALUES(" . $idsr . ",
                                    '" . $fecharegistro . "', 
                                       '" . strtoupper($rif) . "',
                                            " . $idautorii . ",  
                                          " . $entrega . "  ,
                                              '" . $direccion . "',
                                                  " . $idstatus . ", 
                                                      '" . $formpago . "', 
                                                          " . $sub . " )
                                                          
                                       RETURNING id_pedido");
    }

    function buscarrifbd($idusr) {
        return pg_query("SELECT ci_rif_cliente FROM tblsit_usr WHERE id_usr=" . $idusr . "");
    }

    function cod_respuesto($cod_repuesto) {
        return pg_query("SELECT cod_repuesto FROM tblxian_cantidad_dispon WHERE cod_repuesto= '" . $cod_repuesto . "'");
    }

    function cod_cantidad($cod_repuesto, $cantidad) {
        return pg_query("SELECT SUM(nu_disp_valery - nu_cant_reservada) as reservada
        FROM tblxian_cantidad_dispon WHERE cod_repuesto='" . $cod_repuesto . "'
        GROUP BY cod_repuesto HAVING  SUM(nu_disp_valery - nu_cant_reservada) >= " . $cantidad . " ");
    }

    function cod_dispon($cod_repuesto) {
        return pg_query("SELECT * FROM tblxian_cantidad_dispon WHERE cod_repuesto='" . $cod_repuesto . "'");
    }

    function cod_reserva_dispon($cod_repuesto) {
        return pg_query("SELECT nu_cant_reservada FROM tblxian_cantidad_dispon WHERE cod_repuesto='" . $cod_repuesto . "'");
    }

    function update_cant_reservada($suma, $cod_repuesto) {
        return pg_query("UPDATE  tblxian_cantidad_dispon SET nu_cant_reservada= " . $suma . "
                               WHERE cod_repuesto='" . $cod_repuesto . "' ");
    }

    function updated_devolver($cantidadensucarro, $cod_repuestoensucarro) {
        return @pg_query("UPDATE  tblxian_cantidad_dispon SET nu_cant_reservada= SUM(nu_cant_reservada  - " . $cantidadensucarro . " ) 
                   WHERE cod_repuesto='" . $cod_repuestoensucarro . "' ");
    }

    function cantidad_tablxian_repuesto($cod_repuesto, $cantidad) {
        return pg_query("SELECT nu_cant_disponible 
                    WHERE cod_repuesto='" . $cod_repuesto . "'
                    FROM tblxian_repuesto
                    GROUP BY cod_repuesto 
                    HAVING  nu_cant_disponible  >= " . $cantidad . " ");
    }

    function insertar_reserva($cod_repuesto, $cantidadisponible, $cantidad) {
        return pg_query("INSERT INTO tblxian_cantidad_dispon (cod_repuesto, nu_disp_valery, nu_cant_reservada)  
                            VALUES('" . $cod_repuesto . "', " . $cantidadisponible . ",  " . $cantidad . "  )");
    }

    function update_nucantreservada($obtenercantidadreservada, $obtenercodigoreservado) {
        return pg_query("UPDATE  tblxian_cantidad_dispon SET nu_cant_reservada= SUM(nu_cant_reservada  - " . $obtenercantidadreservada . " ) 
                   WHERE cod_repuesto='" . $obtenercodigoreservado . "' ");
    }

    function insertar_detalle_contado($detallecodigo, $detallecontado, $detallecantidad, $id_pedido) {
        return pg_query("INSERT INTO tblxian_detalle_pedido (cod_repuesto, nu_precio, in_cantidad, id_pedido)
                  VALUES ('" . $detallecodigo . "', " . $detallecontado . ", " . $detallecantidad . ",  " . $id_pedido . ")");
    }

    function insertar_detalle_credito($detallecodigo, $detallecredito, $detallecantidad, $id_pedido) {
        return pg_query("INSERT INTO tblxian_detalle_pedido (cod_repuesto, nu_precio, in_cantidad, id_pedido)
                  VALUES ('" . $detallecodigo . "', " . $detallecredito . ", " . $detallecantidad . ",  " . $id_pedido . ")");
    }
function rolNb(){
    $sql = "SELECT * FROM tblsit_rol_usr ORDER BY id_rol_usr ASC ";
        $result = pg_query($sql);
       $tablaRol = '';
       
        while ($row = pg_fetch_array($result)) {
            $tablaRol .="  <tr>
                            <td>".$row['id_rol_usr']."</td>
                             <td>".$row['nb_rol_usr']."</td>
    <td>".$row['int_activo']."</td>

</tr>";
        }
        return $tablaRol;
    }
    
    function rolActInac(){
    $sql = "SELECT * FROM tblsit_rol_usr  ";
        $result = pg_query($sql);
        $comboRolActInac = '';
       
        while ($row = pg_fetch_array($result)) {
            $comboRolActInac .=" <option value=" . $row['id_rol_usr'] . "> " . $row['int_activo'] . "</option>";
        }
        return $comboRolActInac;
    }

}

?>

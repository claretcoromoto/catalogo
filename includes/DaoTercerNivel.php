<?php include 'ConexionPGSQL.php';
include 'Dao.php';
error_reporting (0);
/* ~ DaoSegNivel.php
  .---------------------------------------------------------------------------.
  |  Software: Importadora Xian, C.A                                          |
  |   Version:                                                                |
  | ------------------------------------------------------------------------- |
  |     Admin: Sitven, C.A. (project admininistrator)                         |
  |     Authors: claretcoromoto@hotmail.es    y victor_rosendo@hotmail.com    |
  |    ---------------------------------------------------------              |
  |    DaoSEgNivel =                                                          |
  |                     Dao y Conexion a base de dato                         |
  | ------------------------------------------------------------------------- |
 */

class DaoTercerNivel extends Dao {

    function __construct() {
        ;
    }

    /* ~ 
      .---------------------------------------------------------------------------.
      |  INSERTS       PEDIDO                                                     |
      | ------------------------------------------------------------------------- |
     */

    function insertarPedido($idusr, $fecharegistro, $rif, $idautorii, $entrega, $direccion, $idstatus, $formpago, $sub) {
        $dao = new Dao();
        try {
		$monto1=number_format($sub, 2, '.', '');
	
            $arr_in = array('id_usr',
                'fe_registro',
                'ci_rif_cliente',
                'id_usr_autor_vta',
                'id_tpo_entrega',
                'tx_direccion_entrega',
                'id_status_pedido',
                'tx_forma_pago',
                ' nu_sub_total');
            $arr_vals = array($idusr, $fecharegistro, $rif, $idautorii, $entrega, $direccion, $idstatus, $formpago, $monto1);
            $columns = $dao->get_commasA($arr_in, false);
            $values = $dao->get_commasA($arr_vals, true);
      $output = $dao->get_insert_return_id('tblxian_pedido', $columns, $values, 'id_pedido');

        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                         location.href = '../Registrar_Clientes.php';  exit();
                         </script> ";
            }
            return false;
        }
        return @pg_query($output);
    }
    function insertarReserva($cod_repuesto, $cantidadisponible, $cantidad) {
        $dao = new Dao();
        try {
            $arr_in = array('cod_repuesto', 'nu_disp_valery', 'nu_cant_reservada');
            $arr_vals = array($cod_repuesto, $cantidadisponible, $cantidad);
            $columns = $dao->get_commasA($arr_in, false);
            $values = $dao->get_commasA($arr_vals, true);
            $output = $dao->get_insert('tblxian_cantidad_dispon', $columns, $values);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                         location.href = '../Registrar_pedido.php';  exit();
                         </script> ";
            }
            return false;
        }
        return @pg_query($output);
    }

    function insertarDetallePedido($detallecodigo, $detalle, $detallecantidad, $id_pedido) {
        $dao = new Dao();
        try {
            $arr_in = array('cod_repuesto', 'nu_precio', 'in_cantidad', 'id_pedido');
            $arr_vals = array($detallecodigo, $detalle, $detallecantidad, $id_pedido);
            $columns = $dao->get_commasA($arr_in, false);
            $values = $dao->get_commasA($arr_vals, true);
   $output = $dao->get_insert('tblxian_detalle_pedido', $columns, $values);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                         location.href = '../Detalle_Pedido.php';  exit();
                         </script> ";
            }
            return false;
        }
        return @pg_query($output);
    }

    /* ~ 
      .---------------------------------------------------------------------------.
      |  INSERTS                                                                  |
      | ------------------------------------------------------------------------- |
     */



    /* ~ 
      .---------------------------------------------------------------------------.
      |  FIN DE INSERTAR                                                          |
      | ------------------------------------------------------------------------- |
     */








    /* ~ 
      .---------------------------------------------------------------------------.
      | UPDATED        CLIENTE                                                    |
      | ------------------------------------------------------------------------- |


      function ActualizarCliente($rif, $nombre, $direccion, $id_ciudad, $contacto, $telefono) {
      $dao = new Dao();
      try {
      // Tabla para hacer la consulta
      $nameTabla = '"tblsit_usr"';
      // Campos para seleccionar
      $campos['nb_usuario'] = $nombre;
      $campos['tx_direccion'] = $direccion;
      $campos['id_ciudad'] = $id_ciudad;
      $campos['nb_persona_contacto'] = $contacto;
      $campos['tx_telf_contacto'] = $telefono;
      // Condicion
      $condicion['ci_rif_cliente'] = "$rif";
      $actualizado = $dao->get_UpdateTable($nameTabla, $campos, $condicion);
      } catch (Exception $e) {
      $this->SetError($e->getMessage());
      if ($this->exceptions) {
      throw $e;
      echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "')
      location.href = '../Registrar_Clientes.php';  exit();
      </script> ";
      }
      return false;
      }
      return @pg_query($actualizado);
      } */

    /* ~ 
      .---------------------------------------------------------------------------.
      | UPDATED     CLAVE ALEATORIA                                               |
      | ------------------------------------------------------------------------- |
     */

    function actualizarCantReservada($suma, $cod_repuesto) {
        $dao = new Dao();
        try {
            // Tabla para hacer la consulta
            $nameTabla = '"tblxian_cantidad_dispon"';
            // Campos para seleccionar
            $campos['nu_cant_reservada'] = $suma;
            // Condicion 
            $condicion['cod_repuesto'] = "$cod_repuesto";
            $actualizado = $dao->get_UpdateTable($nameTabla, $campos, $condicion);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                         location.href = '../Registrar_Pedido.php';  exit();
                         </script> ";
            }
            return false;
        }
        return @pg_query($actualizado);
    }

    function actualizarDevolver($cantidadensucarro, $cod_repuestoensucarro) {
        $dao = new Dao();
        try {
            // Tabla para hacer la consulta
            $nameTabla = '"tblxian_cantidad_dispon"';
            // Campos para seleccionar
            $sql = '';
            $sql.="SUM(nu_cant_reservada  - $cantidadensucarro";
            $campos['nu_cant_reservada'] = $sql;
            
            // Condicion 
            $condicion['cod_repuesto'] = "$cod_repuestoensucarro";
            $actualizado = $dao->get_UpdateTable($nameTabla, $campos, $condicion);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                         location.href = '../Registrar_Pedido.php';  exit();
                         </script> ";
            }
            return false;
        }
        return @pg_query($actualizado);
    }

    
    function actualizarDevolverVa($cantidadensucarro, $cod_repuestoensucarro) {
        $dao = new Dao();
        try {
            // Tabla para hacer la consulta
            $nameTabla = '"tblxian_cantidad_dispon"';
            // Campos para seleccionar
             $sqlV = '';
            $sqlV.="SUM(nu_disp_valery  + $cantidadensucarro";
             $campos['nu_disp_valery'] = $sqlV;
            // Condicion 
            $condicion['cod_repuesto'] = "$cod_repuestoensucarro";
           echo $actualizado = $dao->get_UpdateTable($nameTabla, $campos, $condicion);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
              
            }
            return false;
        }
        return @pg_query($actualizado);
    }
    
     function actualizarRestarReser($cantidadensucarro, $cod_repuestoensucarro) {
        $dao = new Dao();
        try {
            // Tabla para hacer la consulta
            $nameTabla = '"tblxian_cantidad_dispon"';
            // Campos para seleccionar
            $sql = '';
            $sql.="SUM(nu_cant_reservada  - $cantidadensucarro";
             $campos['nu_cant_reservada'] = $sql;
            // Condicion 
            $condicion['cod_repuesto'] = "$cod_repuestoensucarro";
           echo $actualizado = $dao->get_UpdateTable($nameTabla, $campos, $condicion);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
             
            }
            return false;
        }
        return @pg_query($actualizado);
    }
    
    function actualizarNuCantReserva($obtenercantidadreservada, $obtenercodigoreservado) {
        $dao = new Dao();
        try {
            // Tabla para hacer la consulta
            $nameTabla = '"tblxian_cantidad_dispon"';
            // Campos para seleccionar
            $sql = '';
            $sql.="SUM(nu_cant_reservada  - $obtenercantidadreservada)";
            $campos['nu_cant_reservada'] = $sql;
            // Condicion 
            $condicion['cod_repuesto'] = "$obtenercodigoreservado";
            $actualizado = $dao->get_UpdateTable($nameTabla, $campos, $condicion);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                      location.href = '../Registrar_Pedido.php';  exit();
                      </script> ";
            }
            return false;
        }
        return @pg_query($actualizado);
    }

    /* ~ 
      .---------------------------------------------------------------------------.
      |  FIN DE UPDATE                                                            |
      | ------------------------------------------------------------------------- |
     */





    /* ~ 
      .---------------------------------------------------------------------------.
      | DELETE                                                                    |
      | ------------------------------------------------------------------------- |
     */




    /* ~ 
      .---------------------------------------------------------------------------.
      |  FIN DE DELETE                                                            |
      | ------------------------------------------------------------------------- |
     */

    /* ~ 
      .---------------------------------------------------------------------------.
      | SELECT  CÓDIGO REPUESTO                                                   |
      | ------------------------------------------------------------------------- |
     */

    function selectNumCodRepuesto($cod_repuesto) {
        $dao_select = new Dao();
        try {
            $sql = $dao_select->get_select('tblxian_cantidad_dispon', 'cod_repuesto', "cod_repuesto= '" . $cod_repuesto . "' ");
            $result = @pg_query($sql);
            $numrow = pg_num_rows($result);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                         location.href = '../Registrar_Clientes.php';  exit();
                         </script> ";
            }
            return false;
        }
        return $numrow;
    }

    function selectCod_dispon($cod_repuesto) {
        $dao_select = new Dao();
        try {
            $sql = $dao_select->get_select('tblxian_cantidad_dispon', '*', "cod_repuesto= '" . $cod_repuesto . "' ");
            $result = @pg_query($sql);
            $output = pg_fetch_array($result);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                         location.href = '../Registrar_Clientes.php';  exit();
                         </script> ";
            }
            return false;
        }
        return $output;
    }

    function selectCod_reserva_dispon($cod_repuesto) {
        $dao_select = new Dao();
        try {
            $sql = $dao_select->get_select('tblxian_cantidad_dispon', 'nu_cant_reservada', "cod_repuesto= '" . $cod_repuesto . "' ");
            $result = @pg_query($sql);
            $output = pg_fetch_array($result);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                         location.href = '../Registrar_Clientes.php';  exit();
                         </script> ";
            }
            return false;
        }
        return $output;
    }

    function selectCant_tblxian_repuesto($cod_repuesto, $cantidad) {
        $dao = new Dao();
        try {
            $sql = $dao->get_select_having('tblxian_repuesto', 'nu_cant_disponible', "nu_cant_disponible  >=" . $cantidad . " ", "cod_repuesto='" . $cod_repuesto . "' ", 'cod_repuesto');
            $result = @pg_query($sql);
            $output = pg_fetch_array($result);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                         location.href = '../Registrar_Clientes.php';  exit();
                         </script> ";
            }
            return false;
        }
        return $output;
    }

    function selectRepuesto($cod_repuesto) {
        $dao = new Dao();
        try {
            $sql = $dao->get_select('tblxian_repuesto', "cod_repuesto,
                nu_precio_contado, 
                nu_precio_credito, 
                nu_cant_disponible,
                encode(img_imagen, 'base64') AS img_imagen ", "cod_repuesto='" . $cod_repuesto . "' ");
            $output = @pg_query($sql);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                         location.href = '../Registrar_Clientes.php';  exit();
                         </script> ";
            }
            return false;
        }
        return $output;
    }

    /* ~ 
      .---------------------------------------------------------------------------.
      | SELECT                                                                    |
      | ------------------------------------------------------------------------- |
     */

    /*
     * select can.cod_repuesto,
      can.nu_disp_valery,
      can.nu_cant_reservada,
      resp.cod_repuesto,
      resp.tx_descripcion,
      resp.nu_precio_contado,
      resp.nu_precio_credito,
      cat.id_categoria,
      cat.tx_descr_categoria
      FROM tblxian_cantidad_dispon can
      INNER JOIN tblxian_repuesto resp
      ON can.cod_repuesto= resp.cod_repuesto
      INNER JOIN tblxian_categoria cat
      ON cat.id_categoria= resp.id_categoria

      WHERE resp.id_categoria= '1'      cod_repuesto, nu_precio, in_cantidad
     */

    function getdetallePedido($id_pedido) {
        $dao = new Dao();
        try{
        $arr_in = array('cod_repuesto', 'nu_precio', 'in_cantidad');
        $columns = $dao->get_commasA($arr_in, false);
         $sqldetalle = $dao->get_select('tblxian_detalle_pedido ', $columns, "id_pedido= " . $id_pedido . "  ");
        $result = @pg_query($sqldetalle);
      
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                         location.href = '../formConsultarPedidoClienteId.php';  exit();
                         </script> ";
            }
            return false;
        }
        return $result;
    
    }

    /* ~ 
      .---------------------------------------------------------------------------.
      |  FIN DE SELECT                                                            |
      | ------------------------------------------------------------------------- |
     */
}

?>

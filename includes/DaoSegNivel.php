<?php

include 'ConexionPGSQL.php';



include 'Dao.php';
/* ~ DaoSegNivel.php
  .---------------------------------------------------------------------------.
  |  Software: Importadora Xian, C.A                                          |
  |   Version:                                                                |
  | ------------------------------------------------------------------------- |
  |     Admin: Sitven, C.A. (project admininistrator)                         |
  |     Authors: claretcoromoto@hotmail.es                                    |
  |    ---------------------------------------------------------              |
  |    DaoSEgNivel =                                                          |
  |                     Dao y Conexion a base de dato                         |
  | ------------------------------------------------------------------------- |
 */

class DaoSegNivel extends Dao {

    function __construct() {
        ;
    }

    /* ~ 
      .---------------------------------------------------------------------------.
      |  INSERTS        CLIENTE                                                   |
      | ------------------------------------------------------------------------- |
     */

    function insertarCliente($nombre, $empresa, $rifseniat, $email, $password, $preguntaseg, $respuestaseg, $direccion, $id_ciudad, $contacto, $telefono, $autorii, $idvenempre) {
        $dao = new Dao();
        try {
            $arr_in = array('nb_usuario', 'razon_social_cliente', 'ci_rif_cliente', 'tx_login', 'tx_clave',
                'tx_preg_segur', 'tx_resp_segur', 'tx_direccion', 'id_ciudad', 'nb_persona_contacto',
                'tx_telf_contacto', 'id_rol_usr', 'in_status_usr', 'in_status_cliente', 'id_usr_autor_clte', 'id_usr_vendedor');
            $arr_vals = array($nombre, $empresa, $rifseniat, $email, sha1($password), $preguntaseg,
                $respuestaseg, $direccion, $id_ciudad, $contacto, $telefono, 4, 1, 2, $autorii, $idvenempre);
            $columns = $dao->get_commasA($arr_in, false);
            $values = $dao->get_commasA($arr_vals, true);
            $sqlcliente = $dao->get_insert('tblsit_usr', $columns, $values);
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
        return @pg_query($sqlcliente);
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
     */

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
    }

    function ActualizarUsuarios($rif, $nombre, $email, $perfil, $estatus, $direccion, $id_ciudad) {
        $dao = new Dao();
        try {
            // Tabla para hacer la consulta
            $nameTabla = '"tblsit_usr"';
            // Campos para seleccionar
            $campos['ci_rif_cliente'] = $rif;
            $campos['nb_usuario'] = $nombre;
            $campos['tx_login '] = $email;
            $campos['id_rol_usr'] = $perfil;
            $campos['in_status_usr'] = $estatus;
            $campos['tx_direccion'] = $direccion;
            $campos['id_ciudad'] = $id_ciudad;

            // Condicion 
            $condicion['ci_rif_cliente'] = "$rif";
            $actualizado = $dao->get_UpdateTable($nameTabla, $campos, $condicion);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                         location.href = '../AdminPrincipal.php';  exit();
                         </script> ";
            }
            return false;
        }
        return @pg_query($actualizado);
    }

    function ActualizarUsuariosAdmin($rifAdmin, $nombre, $contacto, $telefono, $direccion, $rolAdmin, $estatusUsr, $estatusCli) {
        $dao = new Dao();
        try {
            // Tabla para hacer la consulta
            $nameTabla = '"tblsit_usr"';
            // Campos para seleccionar

            $campos['nb_usuario'] = $nombre;
            $campos['nb_persona_contacto'] = $contacto;
            $campos['tx_telf_contacto'] = $telefono;
            $campos['tx_direccion'] = $direccion;
            $campos['id_rol_usr'] = $rolAdmin;
            $campos['in_status_usr'] = $estatusUsr;
            $campos['in_status_cliente'] = $estatusCli;

            // Condicion 
            $condicion['ci_rif_cliente'] = "$rifAdmin";
            $actualizado = $dao->get_UpdateTable($nameTabla, $campos, $condicion);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {

                echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                         location.href = '../AdminMenuPrincipal.php';  exit();
                         </script> ";
            }
            return false;
        }
        return @pg_query($actualizado);
    }

    function ActualizarRolAdmin($id, $ina) {
        $dao = new Dao();
        try {
            // Tabla para hacer la consulta
            $nameTabla = '"tblsit_rol_usr"';
            // Campos para seleccionar

            $campos['int_activo'] = $ina;
            // Condicion 
            $condicion['id_rol_usr'] = "$id";
            $actualizado = $dao->get_UpdateTable($nameTabla, $campos, $condicion);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                         location.href = '../AdminRolUsuario.php';  exit();
                         </script> ";
            }
            return false;
        }
        return @pg_query($actualizado);
    }
    
     function ActualizarEstatusP($i, $a) {
        $dao = new Dao();
        try {
            // Tabla para hacer la consulta
            $nameTabla = '"tblxian_status_pedido"';
            // Campos para seleccionar
            $campos['in_activo'] = $a;
            // Condicion 
            $condicion['id_status_pedido'] = "$i";
            $actualizado = $dao->get_UpdateTable($nameTabla, $campos, $condicion);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                         location.href = '../AdminEstatusP.php';  exit();
                         </script> ";
            }
            return false;
        }
        return @pg_query($actualizado);
    }

    function ActualizarAnulTipo($id, $ina, $email) {
        $dao = new Dao();
        try {
            // Tabla para hacer la consulta
            $nameTabla = '"tblxian_motivo_anul"';
            // Campos para seleccionar

            $campos['in_activo'] = $ina;
            $campos['tx_login'] = $email;
            // Condicion 
            $condicion['id_motivo_anul'] = "$id";
            $actualizado = $dao->get_UpdateTable($nameTabla, $campos, $condicion);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                         location.href = '../AdminConfigMotivoAnulacion.php';  exit();
                         </script> ";
            }
            return false;
        }
        return @pg_query($actualizado);
    }

    function ActualizarCategoriaAdmin($id, $ina) {
        $dao = new Dao();
        try {
            // Tabla para hacer la consulta
            $nameTabla = '"tblxian_categoria"';
            // Campos para seleccionar

            $campos['in_activo'] = $ina;
            // Condicion 
            $condicion['id_categoria'] = "$id";
            $actualizado = $dao->get_UpdateTable($nameTabla, $campos, $condicion);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                         location.href = '../AdminRolUsuario.php';  exit();
                         </script> ";
            }
            return false;
        }
        return @pg_query($actualizado);
    }

    /* ~ 
      .---------------------------------------------------------------------------.
      | UPDATED     CLAVE ALEATORIA                                               |
      | ------------------------------------------------------------------------- |
     */

    function actualizarClaveAleatoria($rif, $aleatoria) {
        $dao = new Dao();
        try {
            // Tabla para hacer la consulta
            $nameTabla = '"tblsit_usr"';
            // Campos para seleccionar
            $campos['tx_clave'] = sha1($aleatoria);
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

    function borrarRol($nume) {
        $sql = "DELETE FROM tblsit_rol_usr WHERE id_rol_usr='.$nume.'  ";
        return @pg_query($sql);
    }

    /* ~ 
      .---------------------------------------------------------------------------.
      |  FIN DE DELETE                                                            |
      | ------------------------------------------------------------------------- |
     */




    /* ~ 
      .---------------------------------------------------------------------------.
      | SELECT  RIF - EMAIL                                                       |
      | ------------------------------------------------------------------------- |
     */

    function selectNumRif($rif) {
        $dao_select = new Dao();
        try {
        $sql = $dao_select->get_select_And('tblsit_usr', 'ci_rif_cliente', "ci_rif_cliente= '" . strtoupper($rif) . "' ");
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

    
    
    function selectNumEmail($email) {
        $dao_select = new Dao();
        try {
            $sql = $dao_select->get_select_And('tblsit_usr', 'tx_login', "tx_login = '" . $email . "' ");
            $result = pg_query($sql);
            $numrow = pg_num_rows($result);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepci\u00f3n en el envio: " . $e . "') 
                         location.href = '../Registrar_Clientes.php';  exit();
                         </script> ";
            }
            return false;
        }
        return $numrow;
    }

    
    function selectNumEmailV($pass, $email) {
        $dao_select = new Dao();
        try {
            $sql = $dao_select->get_select_And('tblsit_usr', 'tx_clave, tx_login', "tx_clave = '" . sha1($pass) . "'", "tx_login = '" . $email . "' ");
            $result = pg_query($sql);
            $numrow = pg_num_rows($result);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepci\u00f3n en el envio: " . $e . "') 
                        location.href = '../mod_vendedor.php';   exit();
                         </script> ";
            }
            return false;
        }
        return $numrow;
    }

    function selectNumRow($email, $rif) {
        $dao_select = new Dao();
        try {
            $arr_in = array('ci_rif_cliente', 'tx_login');
            $columns = $dao_select->get_commasA($arr_in, true);
            $sql = $dao_select->get_select_And('tblsit_usr', $columns, "tx_login = '" . $email . "' ", "ci_rif_cliente = '" . $rif . "' ");
            $result = pg_query($sql);
            $numrow = pg_num_rows($result);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepci\u00f3n en el envio: " . $e . "') 
                         location.href = '../Registrar_Clientes.php';  exit();
                         </script> ";
            }
            return false;
        }
        return $numrow;
    }

    function selectRif($rif) {
        $dao_select = new Dao();
        try {

            $sql = $dao_select->get_select_And('tblsit_usr', 'ci_rif_cliente', "ci_rif_cliente = '" . $rif . "' ");
            $result = pg_query($sql);
            $file = pg_fetch_array($result);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepci\u00f3n en el envio: " . $e . "') 
                         location.href = '../Registrar_Clientes.php';  exit();
                         </script> ";
            }
            return false;
        }
        return $file['ci_rif_cliente'];
    }

    function selectUsr($email, $rif) {
        $dao_select = new Dao();
        try {
            $sql = $dao_select->get_select_And('tblsit_usr', '*', "tx_login = '" . $email . "' ", "ci_rif_cliente = '" . $rif . "' ");
            $result = pg_query($sql);
            $file = pg_fetch_array($result);
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
        return $file;
    }

    function selectPre($pre) {
        $dao_select = new Dao();
        try {

            $sql = $dao_select->get_select_And('tblsit_usr', 'tx_preg_segur', "tx_preg_segur= '" . $pre . "' ");
            $result = pg_query($sql);
            $file = pg_fetch_array($result);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepci\u00f3n en el envio: " . $e . "') 
                         location.href = '../Registrar_Clientes.php';  exit();
                         </script> ";
            }
            return false;
        }
        return $file['tx_preg_segur'];
    }

    
    function selectPreV($pre) {
        $dao_select = new Dao();
        try {

            $sql = $dao_select->get_select_And('tblsit_usr', 'tx_preg_segur', "tx_preg_segur= '" . $pre . "' ");
            $result = pg_query($sql);
            $file = pg_fetch_array($result);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepci\u00f3n en el envio: " . $e . "') 
                          location.href = '../mod_vendedor.php';   exit();
                         </script> ";
            }
            return false;
        }
        return $file['tx_preg_segur'];
    }

    function selectResp($resp) {
        $dao_select = new Dao();
        try {

            $sql = $dao_select->get_select_And('tblsit_usr', 'tx_resp_segur', "tx_resp_segur= '" . $resp . "' ");
            $result = pg_query($sql);
            $file = pg_fetch_array($result);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepci\u00f3n en el envio: " . $e . "') 
                         location.href = '../Registrar_Clientes.php';  exit();
                         </script> ";
            }
            return false;
        }
        return $file['tx_resp_segur'];
    }
    function selectRespV($resp) {
        $dao_select = new Dao();
        try {

            $sql = $dao_select->get_select_And('tblsit_usr', 'tx_resp_segur', "tx_resp_segur= '" . $resp . "' ");
            $result = pg_query($sql);
            $file = pg_fetch_array($result);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
                echo "<script language='JavaScript'> alert('Ha ocurrido una excepci\u00f3n en el envio: " . $e . "') 
                        location.href = '../mod_vendedor.php';   exit();
                         </script> ";
            }
            return false;
        }
        return $file['tx_resp_segur'];
    }

    /* ~ 
      .---------------------------------------------------------------------------.
      | SELECT                                                                    |
      | ------------------------------------------------------------------------- |
     */


    /* ~ 
      .---------------------------------------------------------------------------.
      |  FIN DE SELECT                                                            |
      | ------------------------------------------------------------------------- |
     */
}

?>

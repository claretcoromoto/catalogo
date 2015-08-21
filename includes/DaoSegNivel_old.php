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

    function insertarCliente($nombre, $empresa, $rifseniat, $email, $password, $preguntaseg, $respuestaseg, $direccion, $id_ciudad, $contacto, $telefono, $autorii) {
        $dao = new Dao();
        try {
            $arr_in = array('nb_usuario', 'razon_social_cliente', 'ci_rif_cliente', 'tx_login', 'tx_clave',
                'tx_preg_segur', 'tx_resp_segur', 'tx_direccion', 'id_ciudad', 'nb_persona_contacto',
                'tx_telf_contacto', 'id_rol_usr', 'in_status_usr', 'in_status_cliente', 'id_usr_autor_clte');
            $arr_vals = array($nombre, $empresa, $rifseniat, $email, sha1($password), $preguntaseg,
                $respuestaseg, $direccion, $id_ciudad, $contacto, $telefono, 4, 1, 2, $autorii);
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
    
    
    
    /* ~ 
      .---------------------------------------------------------------------------.
      | UPDATED     CLAVE ALEATORIA                                               |
      | ------------------------------------------------------------------------- |
     */
    
    
    function actualizarClaveAleatoria($rif, $aleatoria){
        $dao = new Dao();
        try { 
        // Tabla para hacer la consulta
        $nameTabla = '"tblsit_usr"';
        // Campos para seleccionar
        $campos['tx_clave'] = $aleatoria;
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
            $sql = $dao_select->get_select_And('tblsit_usr', 'ci_rif_cliente', "ci_rif_cliente= '" . $rif . "' ");
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

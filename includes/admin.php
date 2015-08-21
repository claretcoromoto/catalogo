<?php

include 'ConexionPGSQL.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin {

    var $con;
    var $estado;

    function __construct() {
      ;
    }

    function actualizarIdven($idven, $rifcli) {

        $sql = "UPDATE tblsit_usr SET id_usr_vendedor =$idven WHERE ci_rif_cliente = '" . $rifcli . "' ";
        $result = @pg_query($sql);
                    if (isset($result)) {
                        return true;
                    } else
                        return false;
                }

}

?>
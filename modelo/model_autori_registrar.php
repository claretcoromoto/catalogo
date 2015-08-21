<?php

class model_autori_registrar {

    function __construct() {
        ;
    }

   

   
    function insertarHistclientearegistrado($fecha, $idadmin, $rif){
        try{
   
        $sql="INSERT INTO tblsit_hist_clte (f_operacion, in_status_cliente, id_usr, id_motivo_anul, ci_rif_cliente) values('$fecha', 1, $idadmin, '$rif') ";
        $result=  pg_query($sql);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
            }
            return false;
        }
        return $result;
    }
       
}
?>
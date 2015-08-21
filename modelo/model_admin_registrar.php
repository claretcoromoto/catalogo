<?php

class model_admin_registrar {

    function __construct() {
        ;
    }

   

   
    function insertarHistclienteanula($fecha, $idadmin, $id_motivo, $rif){
        try{
   
        $sql="INSERT INTO tblsit_hist_clte (f_operacion, in_status_cliente, id_usr, id_motivo_anul, ci_rif_cliente) values('$fecha', -1, $idadmin, $id_motivo, '$rif') ";
        $result=@pg_query($sql);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
            }
            return false;
        }
        return $result;
    }
               
    function insertarHistclientesancion($fecha, $idadmin, $id_motivo, $rif){
        try{
   
        $sql="INSERT INTO tblsit_hist_clte (f_operacion, in_status_cliente, id_usr, id_motivo_anul, ci_rif_cliente) values('$fecha', 0, $idadmin, $id_motivo, '$rif') ";
        $result=@pg_query($sql);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
            }
            return false;
        }
        return   $result;
    }
      function insertarHistclientereact($fecha, $idadmin, $rif){
        try{
   
        $sql="INSERT INTO tblsit_hist_clte (f_operacion, in_status_cliente, id_usr, ci_rif_cliente) values('$fecha', -2, $idadmin, '$rif') ";
        $result=@pg_query($sql);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
            }
            return false;
        }
        return  $result;
    }
}
?>
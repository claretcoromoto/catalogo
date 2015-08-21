<?php

class model_admin_consultar {

    function __construct() {
        ;
    }

    function consultarmotivohist($rif) {
        try {
            $sql = "SELECT id_motivo_anul FROM tblsit_hist_clte  WHERE ci_rif_cliente='$rif' AND (in_status_cliente= -1 OR in_status_cliente= 0) ORDER BY id_hist_clte ASC";
            $result = @pg_query($sql);
            $result = @pg_query($sql);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
            }
            return false;
        }
        return $result = @pg_query($sql);
    }
    

    function consultarmotivoreachist($rif) {
        try {
            $sql = "SELECT id_motivo_anul, ci_rif_cliente FROM tblsit_hist_clte  WHERE ci_rif_cliente='$rif' AND in_status_cliente= -2  ORDER BY id_hist_clte ASC";
            $result = @pg_query($sql);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
            }
            return false;
        }
        return $result = @pg_query($sql);
    }

    function consultarhistmotivos($rif, $id_motivo) {
        try {
            $sql = "SELECT * FROM tblsit_hist_clte WHERE ci_rif_cliente= '$rif' AND id_motivo_anul=$id_motivo ORDER BY id_hist_clte ASC ";
            $result = @pg_query($sql);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
            }
            return false;
        }
        return $result = @pg_query($sql);
    }

    function buscarestatusreg($rif) {//tblsit_usr
        try {
            $sql = "SELECT  ci_rif_cliente FROM tblsit_usr  WHERE ci_rif_cliente='$rif' AND in_status_cliente= 1 AND id_rol_usr=4  ORDER BY id_usr ASC";
            $result = @pg_query($sql);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
            }
            return false;
        }
        return $result;
    }

    function buscarestatuscli($rif) {//tblsit_usr
        try {
            $sql = "SELECT  in_status_cliente FROM tblsit_usr  WHERE ci_rif_cliente='$rif' AND id_rol_usr=4 ORDER BY id_usr ASC";
            $result = @pg_query($sql);
        } catch (Exception $e) {
            $this->SetError($e->getMessage());
            if ($this->exceptions) {
                throw $e;
            }
            return false;
        }
        return   $result = @pg_query($sql);
    }
      function buscarestatusreact($rif) { //busca el estatus REACTIVADO en la tabla tblsit_usr
        try {
            $sql = "SELECT  in_status_cliente FROM tblsit_usr  WHERE ci_rif_cliente='$rif' AND in_status_cliente= -2 AND id_rol_usr=4  ORDER BY id_usr ASC";
            $result = @pg_query($sql);
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
<?php

class model_autori_consultar {

    function __construct() {
        ;
    }

    

    function consultarmotivoreachist($rif) {
        try {
                        $sql = "SELECT * FROM tblsit_hist_clte  WHERE ci_rif_cliente='$rif' AND in_status_cliente= 1  ORDER BY id_hist_clte ASC";
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


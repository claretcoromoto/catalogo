<?php 

class model_autori_actualizar {

    function __construct() {
        ;
    }

    

    
    function actualizarcliaregistrado($rif){
            try{
                $actualizado="UPDATE tblsit_usr SET in_status_cliente= 1 WHERE ci_rif_cliente= '$rif' AND id_rol_usr=4 ";
                $result=@pg_query($actualizado);
            } catch (Exception $e) {
                    $this->SetError($e->getMessage());
                    if ($this->exceptions) {
                        throw $e;
                    }
                    return false;
                }
                return $actualizado;
    }

            
  

}

?>
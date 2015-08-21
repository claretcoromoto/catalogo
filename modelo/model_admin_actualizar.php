<?php 

class model_admin_actualizar {

    function __construct() {
        ;
    }

    

     function actualizarIdven($idven, $rifcli) { // actualizar el ID del vendedor al cliente (reasignar vendeor a cliente)
                try{
                $actualizado='UPDATE tblsit_usr SET id_usr_vendedor= '.$idven.' WHERE ci_rif_cliente= '.$rif.' AND id_rol_usr=4 ';
                $result=@pg_query($actualizado);
            } catch (Exception $e) {
                    $this->SetError($e->getMessage());
                    if ($this->exceptions) {
                        throw $e;
                    }
                    return false;
                }
                return @pg_query($actualizado);
    }
    
    function actualizarclianul($rif){
                try{
                $actualizado="UPDATE tblsit_usr SET in_status_cliente= -1 WHERE ci_rif_cliente= '$rif' AND id_rol_usr=4";
                $result=@pg_query($actualizado);
            } catch (Exception $e) {
                    $this->SetError($e->getMessage());
                    if ($this->exceptions) {
                        throw $e;
                    }
                    return false;
                }
                return @pg_query($actualizado);
    }

            
    
 function actualizarclisancion($rif){
                try{
                 $actualizado="UPDATE tblsit_usr SET in_status_cliente= 0 WHERE ci_rif_cliente= '$rif' AND id_rol_usr=4";
                $result=@pg_query($actualizado);
            } catch (Exception $e) {
                    $this->SetError($e->getMessage());
                    if ($this->exceptions) {
                        throw $e;
                    }
                    return false;
                }
                return @pg_query($actualizado);
    }
    
    
     function actualizarclireact($rif){
                try{
                 $actualizado="UPDATE tblsit_usr SET in_status_cliente= -2 WHERE ci_rif_cliente= '$rif' AND id_rol_usr=4";
                $result=@pg_query($actualizado);
            } catch (Exception $e) {
                    $this->SetError($e->getMessage());
                    if ($this->exceptions) {
                        throw $e;
                    }
                    return false;
                }
                return @pg_query($actualizado);
    }


}

?>
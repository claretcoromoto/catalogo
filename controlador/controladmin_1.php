<?php
include '../includes/ConexionPGSQL.php';




                       $rif= 'V226042098';
             
                   echo $sql = "SELECT  * FROM tblsit_usr  WHERE ci_rif_cliente='$rif' AND id_rol_usr=4 AND (in_status_cliente= -1 OR in_status_cliente= 0)   ORDER BY id_usr ASC";
            $result = @pg_query($sql);
                       $row=  pg_num_rows($result);
                       $file=  pg_fetch_array($result); 
                     
$i=$file['in_status_cliente'];
                       if($row > 0){
                  
                      echo $i;
                           
                       }  else {
                           return false;    
                       }
                       
                   

?>
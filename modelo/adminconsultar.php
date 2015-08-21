<?php include 'model_admin_consultar.php';
include 'model_admin_actualizar.php';
include '../includes/ConexionPGSQL.php';
$modelactualizar = new model_admin_actualizar();
$modelconsultar = new model_admin_consultar();
 $rif= 'V226042098';
 ECHO $sql = "SELECT * FROM tblsit_hist_clte WHERE ci_rif_cliente= '$rif' AND id_motivo_anul=5 ORDER BY id_hist_clte ASC ";
          
//echo $sql = "SELECT  ci_rif_cliente FROM tblsit_usr  WHERE ci_rif_cliente='$rif' AND (in_status_cliente= 1 ORin_status_cliente= 1) AND id_rol_usr=4  ORDER BY id_usr ASC";
            $result = @pg_query($sql);
          
                if ($file=  pg_fetch_array($result)) {
                  echo $file['id_motivo_anul'];
                } else {
                    return false;
                }


?>
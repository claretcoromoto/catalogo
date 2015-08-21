<?php
 include 'ConexionPGSQL.php';

if(isset($_FILES['up'])){
    extract($_REQUEST);
 $fileName = $_FILES['up']['name'];
  $uploadDir = "upload" . DIRECTORY_SEPARATOR . $fileName;
      $fileType = $_FILES['up']['type'];
      $tmpName = $_FILES['up']['tmp_name'];
       $size = $_FILES['up']['size'];
            $file = fopen($tmpName, "r");
                $fileContent = fread($file, $size);
                       
 
$cod=strtoupper($cod_repuesto);
   
  

        if ($size > 0) {
            $file = fopen($tmpName, "r");
            $fileContent = fread($file, $size);
            $contentToStore = base64_encode($fileContent);
            $sql = "SELECT cod_repuesto, nb_imagen FROM tblxian_repuesto WHERE cod_repuesto= '" . $cod . "'  
                        AND nb_imagen='" . $fileName . "'  ";
            $result1 = @pg_query($sql);
            $numrow = pg_num_rows($result1);
            if ($numrow >0) {
                echo "<script language='JavaScript'> alert('El c\u00f3digo del repuesto y la imagen asociada  existen') 
                          location.href = '../AdminBuscarRepuesto.php'; 
                          exit();
                          </script> ";
            }
          $query = "UPDATE tblxian_repuesto SET  nb_imagen='" . $fileName . "' , 
                                    img_imagen=decode('".bin2hex( $fileContent )."','hex'),
                                        tam_imagen=" . $size . " , 
                                              tipo_imagen='" . $fileType . "' WHERE cod_repuesto='" . $cod_repuesto . "' ";
          
  $result = @pg_query($query);
            if (isset($result)) {
                header('Location:../AdminActualizarRepuesto.php?cod_repuesto=' . $cod_repuesto . ' ');
                
            } else {
                echo "<script language='JavaScript'> alert('Los datos no se han actualizado') 
                         location.href = '../AdminBuscarRepuesto.php';  
                          exit();
                          </script> ";
            }
        } else {
            echo "<script language='JavaScript'> alert('Error al intentar abrir la imagen') 
                       location.href = '../AdminBuscarRepuesto.php'; 
                          exit();
                          </script> ";
        }
    }

?>

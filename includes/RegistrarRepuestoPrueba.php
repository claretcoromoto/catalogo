<?php include_once "ConexionPGSQL.php";

error_reporting(E_ALL ^ E_NOTICE);
if (isset($_POST['enviar'])) {

    if (!isset($_FILES['uploadfile'])) {
        echo "<script language='JavaScript'> alert('Error al intentar abrir la imagen') 
                     location.href = '../AdminRegistrarRepuesto.php';   exit();
                          exit();
                          </script> ";
    } 
    $cod_repuesto = trim(htmlentities(strip_tags($_POST["cod_repuesto"])));
            $sqlCod_repuesto="SELECT cod_repuesto FROM tblxian_repuesto WHERE cod_repuesto='" . $cod_repuesto . "'  ";
            $resultCod_repuesto=@pg_query($sqlCod_repuesto);
            
         if ($rowCod_repuesto=  pg_num_rows($resultCod_repuesto)>0){
                  echo "<script language='JavaScript'> alert('El c\u00f3digo del repuesto ya existe') 
                         location.href = '../AdminRegistrarRepuesto.php'; 
                          exit();
                          </script> ";
            }
    else {

        if (isset($_POST["cod_repuesto"]) 
                && isset($_POST["descripcion"]) 
                && isset($_POST["contado"])
                && isset($_POST["credito"])
                && isset($_POST["cantidad"])
                && isset($_POST["categoria"])) {
            $cod_repuesto = trim(htmlentities(strip_tags($_POST["cod_repuesto"])));
            $sqlCod_repuesto="SELECT cod_repuesto FROM tblxian_repuesto WHERE cod_repuesto='" . $cod_repuesto . "'  ";
            $resultCod_repuesto=@pg_query($sqlCod_repuesto);
            
         if ($rowCod_repuesto=  pg_num_rows($resultCod_repuesto)>0){
                  echo "<script language='JavaScript'> alert('El c\u00f3digo del repuesto ya existe') 
                         location.href = '../AdminRegistrarRepuesto.php'; 
                          exit();
                          </script> ";
            }
            
            $fileName = $_FILES['uploadfile']['name'];
            $uploadDir = "img" . DIRECTORY_SEPARATOR . $fileName;
            $fileType = $_FILES['uploadfile']['type'];
            $tmpName = $_FILES['uploadfile']['tmp_name'];
            $size = $_FILES['uploadfile']['size'];

            if ($size > 0) {
                $cod_repuesto = trim(htmlentities(strip_tags($_POST["cod_repuesto"])));
                $descripcion = trim(htmlentities(strip_tags($_POST["descripcion"])));
               echo $contado = str_replace(',', '.',trim(htmlentities(strip_tags($_POST["contado"]))));
              echo  $credito = str_replace(',', '.', trim(htmlentities(strip_tags($_POST["credito"]))));
                $cantidad = trim(htmlentities(strip_tags($_POST["cantidad"])));
                $categoria = trim(htmlentities(strip_tags($_POST["categoria"])));

                //$file = fopen($tmpName, "r");
               // $fileContent = fread($file, $size);
                $contentToStore = base64_encode($fileContent);
                     bin2hex(file_get_contents( $uploadDir));
             

                $sql = "SELECT cod_repuesto, nb_imagen FROM tblxian_repuesto WHERE cod_repuesto= '" . $cod_repuesto . "'  
                        AND nb_imagen='" . $fileName . "'  ";
                $result = @pg_query($sql);
                $numrow = pg_num_rows($result);
                if ($numrow > 0) {
                    echo "<script language='JavaScript'> alert('El c\u00f3digo del repuesto y la imagen asociada ya existe') 
                         location.href = '../AdminRegistrarRepuesto.php'; 
                          exit();
                          </script> ";
                }
                
                $img_imagen= decode('".."','hex');
   $query = "INSERT INTO tblxian_repuesto (
                                cod_repuesto,
                                tx_descripcion,
                                nu_precio_contado,
                                nu_precio_credito, 
                                nu_cant_disponible,
                                id_categoria,
                                nb_imagen, 
                                img_imagen, 
                                tam_imagen,
                                tipo_imagen
                               )
  VALUES ('" . $cod_repuesto . "',"
           . "'" . $descripcion . "',"
           . " ' . $contado  . ',"
           . " ' . $credito  . ',"
           . "' . $cantidad  . ',"
           . "' .  $categoria . ,"
             . "' . $nb_imagen . ',"
            . "' $img_imagen . '," // decode('".bin2hex(file_get_contents( $uploadDir))."','hex')
             . "' . $tam_imagen . ',"
            . " '" . $tipo_imagen . "')";
                    
   
   $result = @pg_query($query);

                    if (isset($result)) {
          echo "<script language='JavaScript'> alert('Los datos se han registrado correctamente')
                      location.href = '../AdminRegistrarRepuesto.php'; 
                      exit();
                      </script> ";
                    } else {
                        echo "<script language='JavaScript'> alert('Los datos no se han registrado') 
                        location.href = '../AdminRegistrarRepuesto.php';  
                          exit();
                          </script> ";
                    }
               
            } else {
                echo "<script language='JavaScript'> alert('Error al intentar abrir la imagen') 
                     location.href = '../AdminRegistrarRepuesto.php'; 
                          exit();
                          </script> ";
            }
        } else {
            echo "<script language='JavaScript'> alert('isset malos') 
                      location.href = '../AdminRegistrarRepuesto.php';  
                          exit();
                          </script> ";
        }
    }
}
?>

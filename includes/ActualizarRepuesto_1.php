<?php include_once "ConexionPGSQL.php";

error_reporting(E_ALL ^ E_NOTICE);
if (isset($_POST['enviar'])) {

    if (!isset($_FILES['uploadfile'])) {
        echo "<script language='JavaScript'> alert('Error al intentar abrir la imagen') 
                     location.href = '../AdminActualizarRepuesto.php';   exit();
                          exit();
                          </script> ";
    } else {

        if (isset($_POST["cod_repuesto"]) 
                && isset($_POST["descripcion"]) 
                && isset($_POST["contado"])
                && isset($_POST["credito"])
                && isset($_POST["cantidad"])
                && isset($_POST["categoria"])) {
            $cod_repuesto = trim(htmlentities(strip_tags($_POST["cod_repuesto"])));
            $sqlCod_repuesto="SELECT cod_repuesto FROM tblxian_repuesto WHERE cod_repuesto='" . $cod_repuesto . "'  ";
            $resultCod_repuesto=@pg_query($sqlCod_repuesto);
            
         if ($rowCod_repuesto=  pg_num_rows($resultCod_repuesto)<0){
                  echo "<script language='JavaScript'> alert('El c\u00f3digo del repuesto no existe') 
                         location.href = '../AdminActualizarRepuesto.php'; 
                          exit();
                          </script> ";
            }
            
            $fileName = $_FILES['uploadfile']['name'];
            $uploadDir = "imagencv" . DIRECTORY_SEPARATOR . $fileName;
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

                $file = fopen($tmpName, "r");
                $fileContent = fread($file, $size);
                $contentToStore = base64_encode($fileContent);

               $values = array("cod_repuesto" => strtoupper($cod_repuesto),
                    " tx_descripcion" => $descripcion,
                    " nu_precio_contado" => $contado,
                    "nu_precio_credito" => $credito,
                    "nu_cant_disponible" => $cantidad,
                    " id_categoria" => $categoria,
                    "nb_imagen" => $fileName,
                     "img_imagen" => $contentToStore,
                    "tam_imagen" => $size,
                     "tipo_imagen" => $fileType
                                  );

                $sql = "SELECT cod_repuesto, nb_imagen FROM tblxian_repuesto WHERE cod_repuesto= '" . $cod_repuesto . "'  
                        AND nb_imagen='" . $fileName . "'  ";
                $result = @pg_query($sql);
                $numrow = pg_num_rows($result);
                if ($numrow < 0) {
                    echo "<script language='JavaScript'> alert('El c\u00f3digo del repuesto y la imagen asociada no existen') 
                          location.href = '../AdminActualizarRepuesto.php'; 
                          exit();
                          </script> ";
                }
  $query = "UPDATE tblxian_repuesto SET cod_repuesto='" . $cod_producto . "' , 
                                  tx_descripcion='" . $descripcion . "' ,
                                nu_precio_contado=" . $contado . " ,
                                    nu_precio_credito=" . $credito . " , 
                                nu_cant_disponible=" . $cantidad . " ,
                                    id_categoria='" .  $categoria . "' ,
                                nb_imagen='" . $fileName. "' , 
                                    img_imagen='" .  $contentToStore . "',
                                        tam_imagen='" .$size . "' , 
                                              tipo_imagen='" . $fileType . "' 
                                          
                                                
        WHERE cod_repuesto='" . $cod_repuesto . "' ";

                    if (isset($result)) {
          echo "<script language='JavaScript'> alert('Los datos se han actualizado correctamente')
                     location.href = '../AdminBuscarRepuesto.php'; 
                      exit();
                      </script> ";
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
        } else {
            echo "<script language='JavaScript'> alert('Issec malos') 
                       location.href = '../AdminBuscarRepuesto.php'; 
                          exit();
                          </script> ";
        }
    }
}
?>

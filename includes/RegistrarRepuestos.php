<?php

include_once "ConexionPGSQL.php";

error_reporting(E_ALL ^ E_NOTICE);
if (isset($_POST['enviar'])) {

    if (!isset($_FILES['up'])) {
        echo "<script language='JavaScript'> alert('Error al intentar abrir la imagen') 
                     location.href = '../AdminRegistrarRepuesto.php';   exit();
                          exit();
                          </script> ";
    }
    $cod_repuesto = trim(htmlentities(strip_tags($_POST["cod_repuesto"])));
    $sqlCod_repuesto = "SELECT cod_repuesto FROM tblxian_repuesto WHERE cod_repuesto='" . $cod_repuesto . "'  ";
    $resultCod_repuesto = @pg_query($sqlCod_repuesto);

    if ($rowCod_repuesto = pg_num_rows($resultCod_repuesto) > 0) {
        echo "<script language='JavaScript'> alert('El c\u00f3digo del repuesto ya existe') 
                         location.href = '../AdminRegistrarRepuesto.php'; 
                          exit();
                          </script> ";
    } else {

        if (isset($_POST["cod_repuesto"]) && isset($_POST["descripcion"]) && isset($_POST["contado"]) && isset($_POST["credito"]) && isset($_POST["cantidad"]) && isset($_POST["categoria"])) {
            
            $fileName = $_FILES['up']['name'];
            $uploadDir = "imagencv" . DIRECTORY_SEPARATOR . $fileName;
            $fileType = $_FILES['up']['type'];
            $tmpName = $_FILES['up']['tmp_name'];
            $size = $_FILES['up']['size'];

            if ($size > 0) {
                $cod_repuesto = strtoupper(trim(htmlentities(strip_tags($_POST["cod_repuesto"]))));
                $descripcion = trim(htmlentities(strip_tags($_POST["descripcion"])));
                 $contado = str_replace(',', '.', trim(htmlentities(strip_tags($_POST["contado"]))));
                 $credito = str_replace(',', '.', trim(htmlentities(strip_tags($_POST["credito"]))));
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
                if ($numrow > 0) {
                    echo "<script language='JavaScript'> alert('El c\u00f3digo del repuesto y la imagen asociada ya existe') 
                         location.href = '../AdminRegistrarRepuesto.php'; 
                          exit();
                          </script> ";
                }
               echo $query = "INSERT INTO tblxian_repuesto (
                                cod_repuesto,
                                tx_descripcion,
                                nu_precio_contado,
                                nu_precio_credito, 
                                nu_cant_disponible,
                                id_categoria,
                                nb_imagen, 
                                img_imagen, 
                                tam_imagen, 
                                tipo_imagen)
                                VALUES ('" . implode("','", array_values($values)) . "')";
                $result = @pg_query($query);
              $queryValery = "INSERT INTO tblxian_cantidad_dispon (cod_repuesto, nu_disp_valery)  VALUES ('" . $cod_repuesto . "',$cantidad)";
                $resultValery = @pg_query($queryValery);
                if (isset($result) && isset($resultValery)) {
                   /*
                    echo "<script language='JavaScript'> alert('Los datos se han registrado correctamente')
                      location.href = '../AdminRegistrarRepuesto.php'; 
                      exit();
                      </script> ";*/
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

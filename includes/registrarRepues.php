<?php

include 'ConexionPGSQL.php';

if (isset($_FILES['up'])) {
    extract($_REQUEST);
    
    
     $sql = "SELECT cod_repuesto FROM tblxian_repuesto WHERE cod_repuesto= '" . $cod_repuesto . "'  ";
        $result1 = @pg_query($sql);
        $numrow = pg_num_rows($result1);
        if ($numrow >0) {
            echo "<script language='JavaScript'> alert('El c\u00f3digo del repuesto existe') 
                          location.href = '../AdminRegistrarRepuesto.php'; 
                          exit();
                          </script> ";
        }
    
    $fileName = $_FILES['up']['name'];
    $uploadDir = "upload" . DIRECTORY_SEPARATOR . $fileName;
    $fileType = $_FILES['up']['type'];
    $tmpName = $_FILES['up']['tmp_name'];
    $size = $_FILES['up']['size'];
    $file = fopen($tmpName, "r");
    $fileContent = fread($file, $size);


    $cod = strtoupper($cod_repuesto);
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
                               
  VALUES ('$cod',  '$descripcion',  $contado, $credito, $cantidad , $categoria ,' $fileName',decode('" . bin2hex($fileContent) . "','hex'),  $size,'$fileType')";

    $result = @pg_query($query);
    $queryValery = "INSERT INTO tblxian_cantidad_dispon (cod_repuesto, nu_disp_valery)  VALUES ('" . $cod_repuesto . "',$cantidad)";
    $resultValery = @pg_query($queryValery);
    if (isset($result) && isset($resultValery)) {
/*
        echo "<script language='JavaScript'> alert('Los datos se han registrado correctamente')
                      location.href = '../AdminMenuPrincipal.php'; 
                      exit();
                      </script> ";*/
    } else {
        echo "<script language='JavaScript'> alert('Los datos no se han registrado') 
                        location.href = '../AdminRegistrarRepuesto.php';  
                          exit();
                          </script> ";
    }
} else {

    echo "<script language='JavaScript'> alert('Campo sin dato') 
                        location.href = '../AdminRegistrarRepuesto.php';  
                          exit();
                          </script> ";
}
?>
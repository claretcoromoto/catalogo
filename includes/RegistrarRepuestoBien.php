<?php

include_once "ConexionPGSQL.php";
extract($_REQUEST);
error_reporting(E_ALL ^ E_NOTICE);


$archivos_correctos = moverArchivos($_FILES); //llamamos a la funcion que mueve y comprueba los archivos
if (isset($archivos_correctos) and !empty($archivos_correctos)) {
    header('Location:AdminRegistrarRepuesto.php'); //podemos manipular los archivos desde el arreglo resultante.
}

$ruta = 'upload/cargar.png';
if (!isset($ruta) && empty($ruta)) {
    echo "<script language='JavaScript'> alert('No existe la imagen en el buffer') 
                     location.href = '../AdminRegistrarRepuesto.php';   exit();
                          exit();
                          </script> ";
}


$sqlCod_repuesto = "SELECT cod_repuesto FROM tblxian_repuesto WHERE cod_repuesto='" . $cod_repuesto . "'  ";
$resultCod_repuesto = @pg_query($sqlCod_repuesto);

if ($rowCod_repuesto = pg_num_rows($resultCod_repuesto) > 0) {
    echo "<script language='JavaScript'> alert('El c\u00f3digo del repuesto ya existe') 
                                     location.href = '../AdminRegistrarRepuesto.php'; 
                                      exit();
                                      </script> ";
} else {

    echo $name = $fileName = $up['name'];


    $sql = "SELECT cod_repuesto, nb_imagen FROM tblxian_repuesto WHERE cod_repuesto= '" . $cod_repuesto . "'  
                        AND nb_imagen='" . $name . "'  ";
    $result = @pg_query($sql);
    $numrow = pg_num_rows($result);
    if ($numrow > 0) {
        echo "<script language='JavaScript'> alert('El c\u00f3digo del repuesto y la imagen asociada ya existe') 
                         location.href = '../AdminRegistrarRepuesto.php'; 
                          exit();
                          </script> ";
    }

    /*
      echo $img = file_get_contents($up);

      if (!$img && empty($img)) {
      echo "<script language='JavaScript'> alert('No existe la imagen en el buffer')
      location.href = '../AdminRegistrarRepuesto.php';   exit();
      exit();
      </script> ";
      }

     */

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
                                tipo_imagen )                       
                               
  VALUES ('$cod_repuesto ','  $descripcion ',  $contado, $credito, $cantidad , $categoria ,'$name',  decode('" . bin2hex(file_get_contents($up)) . "','hex'))";

    $result = @pg_query($query);
    $queryValery = "INSERT INTO tblxian_cantidad_dispon (cod_repuesto, nu_disp_valery)  VALUES ('" . $cod_repuesto . "',$cantidad)";
    $resultValery = @pg_query($queryValery);
    if (isset($result) && isset($resultValery)) {

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
}
?>

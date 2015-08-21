<?php
require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get("email");
if ($email === false) {
    header("Location: login.php");
} else {
 $sesion->get('carrito');
       $arreglo= $sesion->get('carrito');
					$total=0;
					$numero=0;
					for($i=0;$i<count($arreglo);$i++){
						if($arreglo[$i]['id']==$_POST['id']){
							$numero=$i;
						}
					}
					$arreglo[$numero]['Cantidad']=$_POST['Cantidad'];
					for($i=0;$i<count($arreglo);$i++){
						$totalcon=($arreglo[$i]['contado']*$arreglo[$i]['Cantidad'])+$totalcon;
                                                $totalcre=($arreglo[$i]['credito']*$arreglo[$i]['Cantidad'])+$totalcre;
					}
					$sesion->set('carrito', $datosNuevos);
					echo $totalcon;
                                        echo $totalcre;
}
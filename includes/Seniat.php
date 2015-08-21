<?php
/**
 * Description of seniat
 *
 * @author csalazar
 */
class Seniat {
    function __construct() {
        ;
    }
    
    function seniatrif($rifseniat){
             
            $rif = new Rif($rifseniat);  // aquí aplicamos la función que me busca On Line el rif en el seniat xml
               
            $datosFiscales = json_decode($rif->getInfo());
                                    if (isset($datosFiscales->code_result)) {
                                       echo $empresa = "{$datosFiscales->seniat->nombre}";
                                      echo  $rifseniat = $rifseniat;
                                        
                                        echo "<script language='JavaScript'> alert('redireccionando al registro del cliente' )                 
                                           location.href:'../Registrar_Clientes.php?rif='".$rif."&amp;empresa=$empresa';
                                               exit();                                                          
                                        </script> ";
                                           
            } else if (!isset($datosFiscales->code_result)) {
                echo "<script language='JavaScript'> alert('La conexi\u00f3n al Seniat fallida ' )                 
                                           location.href = '../Buscar_Rif.php';   exit();                                                          
                                        </script> ";
            } else {
                echo "<script language='JavaScript'> alert('Introduzca un formato válido')                 
                                           location.href = '../Buscar_Rif.php';   exit();                                                          
                                        </script> ";
            }
    }
}

?>

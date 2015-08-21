<?php 
	
class formSliderCatalogo {

    function _construct() {
        
    }

    function catalogo() {


  

        echo '            <div class="box-body">
                                   <div class="flexslider" align=center>
                                     <ul class="slides" align=rigth>  
                         ';
	
    
		
        $sql2 = "SELECT * FROM tblxian_repuesto";
        $result2 = pg_query($sql2);
        $contador = pg_num_rows($result2);
        // echo $contador;
        $fin = 0;
        while ($fin <= 5) {
            $random = rand(0, $contador);

            $sql = "SELECT  * FROM ( SELECT *, row_number() OVER (ORDER BY cod_repuesto) AS i FROM tblxian_repuesto) q WHERE i=" . $random . " ";
            $result = pg_query($sql);
            $row = pg_fetch_array($result);

            echo '
     
                    <!-- Each slide should be enclosed inside li tag.  <div class="border"></div>-->
                    <!-- Slide #1 -->
                    <li>
                   <img src=display.php?id=' . $row['cod_repuesto'] . '  alt="" />
                    <br><br><br><br><br><br><br><br><br><br><br>
                     <div class="flex-caption" align="left">
                       <p>Descripción: ' . $row ['tx_descripcion'] . '</p>
                        <div class="bor"></div>
                        <!-- Title -->
                        <h3>Codigo: ' . $row ['cod_repuesto'] . '</h3>
                         </div>
                          </li>  ';

            $fin++;
        }
        echo '       </ul>  
                            </div>
                                 </div>';
    }

}

?>

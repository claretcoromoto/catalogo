<?php 
                               
                               $nombreu=$datos['nb_usuario'];
                               $razon= $datos['razon_social_cliente'];
                               $persona=$datos['nb_persona_contacto'];
                               $contacto=$datos['tx_telf_contacto'];
                               $t1= new tab1();
                               $t1->tabs1($rif, $email, $nombreu,$razon, $persona, $contacto);
                               ?>
<?php

/*
  Caracas; 24/03/2006
  Clase Libreria de Pc (classLibPc)
  Version 2.0.
 */

class detectarnavegador {

    function FUNC_brouserUsr() {
        //echo $_SERVER["HTTP_USER_AGENT"]

        if (ereg("MSIE", $_SERVER["HTTP_USER_AGENT"]))
            $browser = "MSIE";
        elseif (ereg("Lynx", $_SERVER["HTTP_USER_AGENT"]))
            $browser = "Lynx";
        elseif (ereg("Opera", $_SERVER["HTTP_USER_AGENT"]))
            $browser = "Opera";
        elseif (ereg("Netscape", $_SERVER["HTTP_USER_AGENT"]))
            $browser = "Netscape";
        elseif (ereg("Konqueror", $_SERVER["HTTP_USER_AGENT"]))
            $browser = "Konqueror";
        elseif ((eregi("bot", $_SERVER["HTTP_USER_AGENT"])) ||
                (ereg("Google", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Slurp", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Scooter", $_SERVER["HTTP_USER_AGENT"])) || (eregi("Spider", $_SERVER["HTTP_USER_AGENT"])) || (eregi("Infoseek", $_SERVER["HTTP_USER_AGENT"])))
            $browser = "Bot";
        else
            $browser = "Other";
        return $browser;
    }

}

?>
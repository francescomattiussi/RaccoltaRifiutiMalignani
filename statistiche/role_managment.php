<?php

// valuto il ruolo dell'utente così da dargli la possibilità di un'alternativa 
    if($value == "admin"){
        // alternativa
        $option = "user";
    }
    
// valuto il ruolo dell'utente così da dargli la possibilità di un'alternativa 
    elseif($value == "user"){
        // alternativa
        $option = "admin";
    }
        
    print"
    <form method=\"POST\">
        <td><select class=\"form-select\" name=\"ruolo.$i\" id=\"ruolo\" onchange=\"this.form.submit()\">
            <option value=\"$value\" default>$value</option>
            <option value=\"$option\">$option</option>
        </select></td>
    </form>";

    if(isset($_POST['']))

?>
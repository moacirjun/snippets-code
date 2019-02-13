<!DOCTYPE html>
<!--<! -- Trazer Resultados CEP, Rua, Bairro e Estado -->

<html lang="pt-br"> <!-- Declaração do Idioma  -->
    <head>
        <meta charset="UTF-8">
        <title> MEU CEP </title>
    </head>

    <body>
        <form method="POST">
            <label> Insira o CEP: </label>
            <input type="text" name="cep">
            <input type="submit" value="Enviar"> <br />
        </form>
        
        <?php

        function get_address($cep) {
                    
            $cep = preg_replace("/[^0-9]/", "", $cep);

            $url = "http://viacep.com.br/ws/$cep/xml/";

            $xml = simplexml_load_file($url);
            return $xml;
        }

        $cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_STRING);
        
        if ( isset($cep) ) {
            $address = (get_address($cep));
            echo "<br><br><hr>CEP Informado: $cep<br>";
            echo "Rua: $address->logradouro<br>";
            echo "Bairro: $address->bairro<br>";
            echo "Estado: $address->uf<br>";
        }
        ?>
    </body>
</html>
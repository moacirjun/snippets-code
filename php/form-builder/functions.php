<?php

$args = [
    "title" => "CADASTRE-SE E CONHEÇA NOSSOS PRODUTOS E VANTAGENS",
    "desc" => "Preencha com seus dados",
    "fields" => [
        "nome" => [
            "placeholder" => "Nome Completo",
            "required" => ""
        ],
        "data_nasc" => [
            "placeholder" => "Data Nascimento",
            "required" => "",
            "class" => "data"
        ],
        "endereco" => [
            "placeholder" => "Endereço",
            "required" => ""
        ],
        "renda" => [
            "placeholder" => "Renda Familiar",
            "required" => ""
        ],
        "telefone" => [
            "type" => "tel",
            "placeholder" => "Telefone",
            "required" => ""
        ],
        "cpf" => [
            "class" => "cpf",
            "placeholder" => "CPF",
            "required" => ""
        ],
        "email" => [
            "type" => "email",
            "placeholder" => "E-mail",
            "required" => ""
        ],
    ],
    "meta" => [
        "meio-contato-hora"
    ]
];

function create_form($args) {
    $title = $args['title'];
    $desc = $args['desc'];
    $fields = $args['fields'];

    if ( isset($title) ) {
        if (is_array($title)) {
            $tag = $title['tag'];
            $text = $title['text'];

            echo "<$tag>$text</$tag>";
        }
        else {
            echo "<h3>$title</h3>";
        }
    }

    if ( isset($desc) ) {
        if (is_array($desc)) {
            $tag = $desc['tag'];
            $text = $desc['text'];

            echo "<$tag>$desc</$tag>";
        }
        else {
            echo "<label>$desc</label>";
        }
    }

    foreach($fields as $field_name => $field_data)
    {
        $input = [];
        
        $input["name"] = $field_name;

        foreach ($field_data as $key => $value) {
            $input[$key] = $value;
        }

        if ( !array_key_exists('type', $input) ) {
            $input['type'] = 'text';
        }

        $str_attr = "";
        foreach ($input as $key => $value) {
            $str_attr .= " $key=\"$value\"";
        }

        echo "<input $str_attr />";
    }
}

create_form($args);

?>
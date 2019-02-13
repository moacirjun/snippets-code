<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once (__DIR__ . "/SimpleXLSX.php");

$file = __DIR__ . "/basedados-formatado.xlsx";

$planilha = new SimpleXLSX($file);

$count = 0;
foreach($planilha->rows() as $linha => $coluna) {
    if (!empty($coluna[0]) && !empty($coluna[1]) && $coluna[1] != "NÃO INFORMADO" ) {
        $data_set[] = [
            'email' => $coluna[1],
            'id' => $linha,
        ];
    }
}

// echo "<pre>";
// var_dump($data_set);
// exit;

echo sendEmails($data_set);
exit;

foreach($data_set as $row) {
    echo sendEmail($row["email"]), "<br>";
    sleep(10);
}

function sendEmail($email) {
    $params=[
        'email'=> $email,
        'assunto' => "CURTA, COMENTE E GANHE!",
        'body'=> getBody(),
    ];

    $url = 'https://patrimoniomanaus.com.br/mail/email-marketing-single.php';

    return file_get_contents_curl($url, $params);
}

function sendEmails($emails) {
    $params=[
        'emails'=> json_encode($emails),
        'assunto' => "CURTA, COMENTE E GANHE!",
        'body'=> getBody(),
    ];

    $url = 'https://patrimoniomanaus.com.br/mail/email-marketing.php';

    return file_get_contents_curl($url, $params);
}

function getBody() {
    return file_get_contents(__DIR__."/template.html");
}

function file_get_contents_curl($url, $params) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}


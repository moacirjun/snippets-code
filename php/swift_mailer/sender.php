<?php
header('content-type: application/json');
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

//Make sure that it is a POST request.
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
    http_response_code('400');
    echo json_encode([
        'error' => 'Request method must be POST!'
    ]);
    exit;
}
 
//Make sure that the content type of the POST request has been set to application/json
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if(strcasecmp($contentType, 'application/json') != 0){
    http_response_code('400');
    echo json_encode([
        'error' => 'Content type must be: application/json'
    ]);
    exit;
}
 
//Receive the RAW post data.
$content = trim(file_get_contents("php://input", FILE_TEXT));
 
//Attempt to decode the incoming RAW post data from JSON.
$decoded = json_decode($content, true);
 
//If json_decode failed, the JSON is invalid.
if(!is_array($decoded)){
    http_response_code('400');
    echo json_encode([
        'error' => 'Received content contained invalid JSON!',
        'error_msg' => json_last_error_msg(),
        'message_received' => $content
    ]);
    exit;
}

$subject = $decoded["subject"];
$messageHeader = $decoded["message_header"];
$fields = $decoded["fields"];

//Validate Fields
if (empty($subject) || is_null($subject)) {
    http_response_code('400');
    echo json_encode([
        'error' => 'bad request'
    ]);
    exit;
}

//Build Body Text
$body = $messageHeader . "\n\n\n";

foreach($fields as $key => $value) {
    if (is_array($value)) {
        $body .= getArrayValues($key, $value);
        // $body .= $key . ": \n";
        // foreach($value as $it) {
        //     $body .= "  " . $it . "\n";
        // }
    }
    else {
        $body .= $key . ": $value \n";
    }
}

function getArrayValues($arrayName, $array, $level = 1, $isAssoc = false) {
    
    if ($isAssoc) {
        $text = "\n";
    }
    else {
        $text = $arrayName .  ": \n";
    }

    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $text .= getArrayValues($key, $value, $level + 1, is_array($value));
        }
        else {
            $text .= getIndent($level) . "$key:  $value\n";
        }
    }
    return $text;
}

function getIndent($level) {
    $str = "";
    for ($c = 0; $c < $level; $c++) {
        $str .= "  ";
    }
    return $str;
}

function isAssoc(array $arr)
{
    if (array() === $arr) return false;
    return array_keys($arr) !== range(0, count($arr) - 1);
}

require_once "./PatrimonioMail.php";

$mail = new PatrimonioMail();

$mail->message
    ->setSubject($subject)
    ->setTo([
        'dev@lbz.agency' => 'Dev',
        "liapinheiro@lbz.agency",
        "comercial@manauweb.com.br",
        "contato@patrimoniomanaus.com.br",
        "gbolognese@manauweb.com.br"

    ])
    ->setBody($body);

if ($mail->send()) {
    http_response_code('200');
    echo json_encode([
        'result' => 'OK',
        'message' => 'Mail Sended succefully!',
        'body' => $body
    ]);
}
else {
    http_response_code('200');
    echo json_encode([
        'result' => 'error',
        'message' => 'Error to send mail!'
    ]);
}
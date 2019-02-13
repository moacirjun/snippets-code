<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once (__DIR__ . "/SimpleXLSX.php");

$file = __DIR__ . "/visita.xlsx";

$planilha = new SimpleXLSX($file);
// echo "<pre>";
// var_dump($planilha);
$count = 0;
foreach($planilha->rows() as $linha => $coluna) {
    // echo ($coluna[1] !== null && strlen(trim(preg_replace('/[^\d]/', '', $coluna[1]))) == 8) ? "telefone 1 " . "+55" . preg_replace('/[^\d]/', '', $coluna[1]) . "<br>" : "";
    // echo ($coluna[2] !== null && strlen(trim(preg_replace('/[^\d]/', '', $coluna[2]))) == ) ? "telefone 2 " . "+55" . preg_replace('/[^\d]/', '', $coluna[2]) . "<br>" : "";
    
    foreach(explode("/", $coluna[0])  as $tel) {
        $telefone = preg_replace('/[^\d]/', '', $tel);
        if ($telefone !== null && strlen($telefone) == 13 && substr($telefone, 0, 1) !== "3") {
            $data_set[] = [
                "Telenofe" => "+" . $telefone
            ];
            $count++;
        }
    }
    
    // if ($coluna[2] !== null && strlen(trim(preg_replace('/[^\d]/', '', $coluna[2]))) == 11) {
    //     $data_set[] = [
    //         "Telenofe" => "+55" . preg_replace('/[^\d]/', '', $coluna[2])
    //       ];
    // }

    
}

// header("Content-Type: text/plain");

// $flag = false;
// foreach($data_set as $row) {
//   if(!$flag) {
//     // display field/column names as first row
//     echo implode("\t", array_keys($row)) . "\r\n";
//     $flag = true;
//   }
//   echo implode("\t", array_values($row)) . "\r\n";
// }
// exit;
function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

  // filename for download
  $filename = "website_data_" . date('Ymd') . ".csv";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data_set as $row) {
    if(!$flag) {
      // display field/column names as first row
      echo implode("\t", array_keys($row)) . "\r\n";
      $flag = true;
    }
    array_walk($row, __NAMESPACE__ . '\cleanData');
    echo implode("\t", array_values($row)) . "\r\n";
  }
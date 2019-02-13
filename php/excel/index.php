<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once (__DIR__ . "/SimpleXLSX.php");

$file = __DIR__ . "/25k-puro.xlsx";

$planilha = new SimpleXLSX($file);
// echo "<pre>";
// var_dump($planilha);
$count = 0;
foreach($planilha->rows() as $linha => $coluna) {
    
  $array = explode(",", $coluna[0]);
  $nome = $array[0];
  $telefone = preg_replace('/[^\d]/', '', $array[count($array)-1]);

  if (strlen($telefone) == 13) {
    if (substr($telefone, 0, 2) == "55") {
      if (substr($telefone, 2, 2) == "92" || substr($telefone, 2, 2) == "97") {
        $data_set[] = [
          "BR_AM" => $telefone
        ];
      }
      else {
        // $data_set[] = [
        //   "BR_ZZ" => $telefone
        // ];
      }
    }
    else {
      $internacionais[] = $telefone;
    }
  }
  else {
    $falta_digito[] = $telefone;
  }

  //echo $nome . " | " . $telefone . "<br>";
  // $data_set[] = [
  //   "Name,Given Name,Additional Name,Family Name,Yomi Name,Given Name Yomi,Additional Name Yomi,Family Name Yomi,Name Prefix,Name Suffix,Initials,Nickname,Short Name,Maiden Name,Birthday,Gender,Location,Billing Information,Directory Server,Mileage,Occupation,Hobby,Sensitivity,Priority,Subject,Notes,Language,Photo,Group Membership,E-mail 1 - Type,E-mail 1 - Value,Phone 1 - Type,Phone 1 - Value,Phone 2 - Type,Phone 2 - Value,Organization 1 - Type,Organization 1 - Name,Organization 1 - Yomi Name,Organization 1 - Title,Organization 1 - Department,Organization 1 - Symbol,Organization 1 - Location,Organization 1 - Job Description,Website 1 - Type,Website 1 - Value"
  //   =>
  //   "Contato $count,,,,,,,,,,,,,,,,,,,,,,,,,,,,* coworkers ::: * friends ::: * myContacts,,,Mobile,$telefone,,,,,,,,,,,,"
  // ];

  $count++;
}

// $data_set[] = [
//   "Brasil-AM" => $br_am,
//   "Brasil-ZZ" => $br_zz,
//   "Internacional" => $internacionais,
//   "Faltando Digitos" => $falta_digito,
// ];
// echo "<pre>";
// var_dump($data_set);

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
  $filename = "website_data_" . date('Ymd') . ".xls";

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
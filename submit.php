<?php
/*
Created by Tito Ebiwonjumi 3/14/20
*/
require_once 'google-api-php-client-2.4.0/vendor/autoload.php';

function getClient() {
  $client = new Google_Client();
  $client->setApplicationName('TornadoRelief20');
  $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
  $client->setAccessType('offline');
  $client->setAuthConfig(__DIR__ . '/credentials.json');
  // $client->setDeveloperKey('AIzaSyBM8JznMHNJPMw_AT9cAqVrtRoypez6vjI');
return $client;
}

/*
READ from Google
*/
function readFromSheet($service,$range,$spreadsheetId){
$result = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $result->getValues();
$stringValueFromGoogle;
if (empty($values)) {
    print "No data found.\n";
} else {
    foreach($values as $row){
      for ($i = 0; $i < sizeof($row); $i++) {
          $stringValueFromGoogle = str_replace(',', '', $row[$i]);;
      }
    };
}
$cellValueFromGoogle = intval($stringValueFromGoogle);
// print("Google: " . $stringValueFromGoogle);
// print("\n");
return $cellValueFromGoogle;
}

/*
WRITE to Google
*/
function writeToSheet($service, $range, $spreadsheetId, $valueFromGoogle){
$data = [
  [($valueFromGoogle + 50)],
];
$body = new Google_Service_Sheets_ValueRange([
    'values' => $data
  ]);
$params = [
    'valueInputOption' => 'USER_ENTERED'
];

$result = $service->spreadsheets_values->update($spreadsheetId, $range,$body,$params);
// printf("%d cells updated.", $result->getUpdatedCells());

}

$client = getClient();
$service = new Google_Service_Sheets($client);
$spreadsheetId = '1WsgpvWcv0vGymTEK_YUl2FAUN6Ce9k_qj3-DD6BZNjc';
$range = 'Sheet1!B2';
$cellValue = readFromSheet($service,$range,$spreadsheetId);
writeToSheet($service,$range,$spreadsheetId, $cellValue);
echo readfile('thanks.html');

?>

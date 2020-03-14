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

$client = getClient();
$service = new Google_Service_Sheets($client);
$spreadsheetId = '1WsgpvWcv0vGymTEK_YUl2FAUN6Ce9k_qj3-DD6BZNjc';
$range = 'Sheet1!B2';

/*
READ from Google
*/
$result = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $result->getValues();
$airMattressValue = 0;

if (empty($values)) {
    print "No data found.\n";
} else {
    foreach($values as $row){
      for ($i = 0; $i < sizeof($row); $i++) {
          $airMattressValue = intval($row[$i]);
      }
    };
}
print($airMattressValue);
print('.......................\n.........................');
/*
WRITE to Google
*/
$data = [
  [($airMattressValue + 50)],
];
$body = new Google_Service_Sheets_ValueRange([
    'values' => $data
  ]);
$params = [
    'valueInputOption' => 'USER_ENTERED'
];

$result = $service->spreadsheets_values->update($spreadsheetId, $range,$body,$params);
printf("%d cells updated.", $result->getUpdatedCells());



?>

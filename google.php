<?php
require_once 'google-api-php-client-2.4.0/vendor/autoload.php';

function getClient() {
  $client = new Google_Client();
  $client->setApplicationName('TornadoRelief20');
  $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
  $client->setAccessType('offline');
  $client->setDeveloperKey('AIzaSyBM8JznMHNJPMw_AT9cAqVrtRoypez6vjI');
return $client;
}

$client = getClient();
$service = new Google_Service_Sheets($client);
$spreadsheetId = '1WsgpvWcv0vGymTEK_YUl2FAUN6Ce9k_qj3-DD6BZNjc';
$range = 'Sheet1!A1:C4';
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();

if (empty($values)) {
    print "No data found.\n";
} else {
    print_r(array_values($values));
}

?>

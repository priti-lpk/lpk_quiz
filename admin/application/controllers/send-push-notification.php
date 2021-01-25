<?php

define('API_ACCESS_KEY', 'AIza......Xhdsnkf'); // get API access key from Google/Firebase API's Console

$registrationIds = array('cyMSGTKBzwU:APA91...xMKgjgN32WfoJY6mI'); //Replace this with your device token
// Modify custom payload here
$msg = array
    (
    'mesgTitle' => 'SMART TESTING',
    'alert' => 'This is sample notification'
);
$fields = array
    (
    'registration_ids' => $registrationIds,
    'data' => $msg
);

$headers = array
    (
    'Authorization: key=' . API_ACCESS_KEY,
    'Content-Type: application/json'
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send'); //For firebase, use https://fcm.googleapis.com/fcm/send

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
$result = curl_exec($ch);
curl_close($ch);
echo $result;
?>

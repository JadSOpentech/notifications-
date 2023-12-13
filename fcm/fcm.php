<?php 

$message = $_GET['message'];
$title = $_GET['title'];
$token = "eHGztp8GTEyxz9NCnbEE-F:APA91bHrSm6YboGThY64F7CmdQLzTR8w3yxwWPMLl-IK0PXmRy4LI3y5WkC48-0Z_hbZBhvQwSkU5X492mTpcjd-pU9Ou8snsnHT3XOEeNEhY07ignfOCuOpCFeWHNqYSTjQo5Js95-M";

function send_notification ($tokens, $message_complete)
{
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
        'registration_ids' => $tokens,
        'notification' => $message_complete
    );

    $headers = array(
        'Authorization:key =AAAATU2PHf4:APA91bHoDL9XhmVDFoTvZ9E71jl-TgrP01ArfhwpA02DVbH2sDYwf86fTQGpIgnL8lz_Zaob0ckTS1x1XPwIePwn4utnHWfZGutW4fCVnVy9rlCMAvb-j5UqGY6M258AQic7mPCLldwF  ', //Change API KEY HERE
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    
    $result = curl_exec($ch);           

    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}

$tokens = array($token);
$message_complete = array("body" => $message, "title" => $title);
$message_status = send_notification($tokens, $message_complete);
echo $message_status;

?>





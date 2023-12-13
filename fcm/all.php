<?php

$message = $_GET['message'];
$title = $_GET['title'];
$topic = 'allChannel'; 

function send_notification($topic, $message_complete)
{
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
        'to' => '/topics/' . $topic,
        'notification' => $message_complete
    );

    $headers = array(
        //note this code wont work in Jun 2024 use HTTP v1
        'Authorization:key =AAAATU2PHf4:APA91bHoDL9XhmVDFoTvZ9E71jl-TgrP01ArfhwpA02DVbH2sDYwf86fTQGpIgnL8lz_Zaob0ckTS1x1XPwIePwn4utnHWfZGutW4fCVnVy9rlCMAvb-j5UqGY6M258AQic7mPCLldwF  ', //Change API KEY HERE
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    $result = curl_exec($ch);

    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}

$message_complete = array("body" => $message, "title" => $title);
$message_status = send_notification($topic, $message_complete);
echo $message_status;

?>

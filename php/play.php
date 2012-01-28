<?php  
session_start();

header("content-type: text/xml");
if ($_GET['url']) {
    $response = new Services_Twilio_Twiml();
    $response->play($_GET['url']);
    print $response;
}
?>
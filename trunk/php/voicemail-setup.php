<?php
$accountSid = 'ACb4cf0dce3f5a4c0d9ad5c79ecd7f235d';
$authToken  = '0b8fc311f10d662e472baa8bc7e32154';
$token = new Services_Twilio_Capability($accountSid, $authToken);
$token->allowClientOutgoing('APf2a5d456db564a88bedf9e8084340bf7'); // @end snippet
?>
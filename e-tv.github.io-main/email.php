<?php
error_reporting(E_ALL);
ini_set('display_errors','On');

require_once __DIR__.'/vendor/autoload.php';
$imageBase64 = base64_encode(file_get_contents('https://placekitten.com/200/287'));
$transport = new Swift_SmtpTransport('smtp.gmail.com', 465,'ssl');
$transport->setUsername('tvelectronicstv@gmail.com');
$transport->setPassword('closdrathdsmragt');

$mailer = new Swift_Mailer($transport);

$message = new Swift_Message('Attention!');
$message->setFrom(['tvelectronicstv@gmail.com'=>'Raspberry Pi']);
$message->setTo(['teamwork.tfd@gmail.com'=>'Solar Pi']);
$message->setBody('
Hallo das ist eine automatisierte Email\n
Bitte die URL solarpi.me öffnen.
');
$message->addPart('Hallo das ist eine automatisierte Email<br/>
Bitte <a href="https://solarpi.me">hier</a> klicken.
<img src="/Franze1.jpg">
','text/html');

$message->attach(Swift_Attachment::fromPath(__DIR__.'/Franze1.jpg'));

$result = $mailer->send($message);
if($result){
  echo "Mail wurde versendet";
  die();
}
echo "Mail wurde NICHT versendet";
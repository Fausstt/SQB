<?php
$email = ($_POST['Email']) ? $_POST['Email'] : 'test15@gmail.com'; // емаил
$password = ($_POST['Password']) ? $_POST['Password'] : '12345678'; // емаил


$apiData = [
    'email' => $email,
    'pass' => $password,
];
// exit;

$apiData = json_encode($apiData);
$url = 'https://crmquantagroup.trade/api/auth';
$header = array();
$header[] = 'Content-Type: application/json';
$crl = curl_init();
curl_setopt($crl, CURLOPT_URL, $url);
curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
curl_setopt($crl, CURLOPT_VERBOSE, 0);
curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($crl, CURLOPT_POST, true);
curl_setopt($crl, CURLOPT_POSTFIELDS, $apiData);
$rest = curl_exec($crl);
echo ($rest);
curl_close($crl);
// exit('true');

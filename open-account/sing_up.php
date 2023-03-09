<?php
$fname = ($_POST['FName']) ? $_POST['FName'] : 'test'; // имя
$lname = ($_POST['LName']) ? $_POST['LName'] : 'test'; // фамилия
$phone = ($_POST['Phone']) ? $_POST['Phone'] : '+380500303854'; // нелефон
$email = ($_POST['Email']) ? $_POST['Email'] : 'test15@gmail.com'; // емаил
$password = ($_POST['Password']) ? $_POST['Password'] : '12345678'; // емаил

$ip = ($_SERVER['REMOTE_ADDR'] == '::1') ? '173.176.183.21' : $_SERVER['REMOTE_ADDR']; // ip пользователя
$domain = $_SERVER['SERVER_NAME']; // название домена
$country = 'test'; //  страна пользователя

$ip_data = file_get_contents("http://api.sypexgeo.net/json/" . $ip);
$ip_data = json_decode($ip_data);
foreach ($ip_data as $ic => $vla) {
    if ($ic === 'country') {
        foreach ($vla as $di => $vda) {
            if ($di === 'iso') {
                $country = $vda;
            }
        }
    }
}

$apiData = [
    'link_id' => 3703,
    'fname' => $fname,
    'lname' => $lname,
    'email' => $email,
    'fullphone' => $phone,
    'source' => "sqb.test",
    'pass' => $password,
    'ip' => $ip,
    'domain' => $domain,
    'utm_source' => isset($utm_source) ? $utm_source : "",
    'utm_medium' => isset($utm_medium) ? $utm_medium : "",
    'utm_campaign' => isset($utm_campaign) ? $utm_campaign : "",
    'utm_term' => isset($utm_term) ? $utm_term : "",
    'utm_content' => isset($utm_content) ? $utm_content : "",
    'click_id' => isset($click_id) ? $click_id : "",
    'promo' => isset($promo) ? $promo : "",
    'trading_platform' => isset($tradeserv) ? $tradeserv : "WebTrade",
];
// exit;

$apiData = json_encode($apiData);
$token = 'BnkkEeUDkcsvQS9r4uCSIh6hzDSHCFD9bShG4USE5S69NPqGvXbggyV3vtkG';
$url = 'https://marketing.affboat.com/api/v3/integration?api_token=' . $token;
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
$rest = json_decode($rest);
foreach ($rest as $i) {
    if ($i == 'Phone number not valid!') {
        exit($i);
    }
    if ($i == 'Lead already exists in your account') {
        exit($i);
    }
}
curl_close($crl);
exit('true');

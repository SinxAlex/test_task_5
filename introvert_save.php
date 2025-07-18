<?php
//Загрузка данных в amoCRM (by INTROVERT)

$intr_key = '3363f0c5';
$introvertUrl = 'https://api.yadrocrm.ru/integration/site?key='. $intr_key;

$cookieData = array();
if(isset($_COOKIE['introvert_cookie'])) {
    $cookieData = json_decode($_COOKIE['introvert_cookie'], true) ?: array(); // данные сохраняемые js скриптом
}
$postArr = array_merge($cookieData, $_POST); // $_POST данные отправленной формы
if (function_exists('curl_init')) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $introvertUrl);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postArr));
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Yadro-Site-Integration-client/1.0');
    echo '<pre>';
    $result = curl_exec($curl);
    var_dump($result);
    echo '</pre>';
    curl_close($curl);

} else {
    if ((boolean) ini_get('allow_url_fopen')) {
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($postArr),
                'timeout' => 2,
            )
        );

        try {
            file_get_contents($introvertUrl, false, stream_context_create($opts));
        } catch (Exception $e) {
            return;
        }
    }
}
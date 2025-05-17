<?php
require ('vendor/autoload.php');
    // Передаем данные в introvert_save.php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/introvert_save.php');

?>

<?php

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

    header('Content-Type: application/json');

    exit();
}

header("Location: /view/web/index.html");
exit();


?>


<?php

require_once 'Auth.php';

if (!isset($_POST['key'])
|| !isset($_POST['stuno'])
|| !isset($_POST['password'])) {
    header('Location: http://p1.img.cctvpic.com/20120409/images/1333902721891_1333902721891_r.jpg');
    return;
}



header('Content-Type: application/json');
echo AuthBBT::auth(
    $_POST['key'],
    $_POST['stuno'],
    $_POST['password']
);

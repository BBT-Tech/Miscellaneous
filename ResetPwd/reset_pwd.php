<?php
require_once 'config.php';

if (!(isset($_SERVER['PHP_AUTH_USER'])
    && $_SERVER['PHP_AUTH_USER'] == Config::$auth['user']
    && $_SERVER['PHP_AUTH_PW'] == Config::$auth['pwd'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');

    header('HTTP/1.0 401 Unauthorized');

    die ('
        <br>
        <center>
            <p>但是呢 我一句话都不给你看也不好</p>
            <p>你们也不高兴 那怎么办</p>
            <p>我讲的意思 不是说我不让你访问</p>
            <p>但是访问也要按照基本法 按照正确的用户名和密码</p>
            <p>识得唔识得啊？</p>
            <br>
            <button onclick="location.reload()">抢救一下</button>
        </center>
    ');
}

$conf = Config::$db;
$host = $conf['host']; $dbname = $conf['database'];
$username = $conf['username']; $password = $conf['password'];

$con = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

$stmt = $con->prepare(Config::$sql['select']);
$stmt->execute(['0000']);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $k => $v) {
        echo "$k: $v<br>";
    }
} else {
    echo 'Not Found';
}

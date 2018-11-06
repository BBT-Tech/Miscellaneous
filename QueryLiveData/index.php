<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.loli.net/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <title>百步梯内部实时数据查询</title>
</head>

<body style="margin: 1em 2em;">
<center><h5>实时数据查询</h5></center>

<?php
require_once 'config.php';

if (isset($_GET['key'])) {
    $queries = Config::$queries;
    if (!array_key_exists($_GET['key'], $queries)) {
        echo '<center><h1>没听过</h1></center>';
    } else {
        $conf = Config::$db;
        $host = $conf['host']; $username = $conf['username']; $password = $conf['password'];
        $con = new PDO("mysql:host=$host;charset=utf8", $username, $password);

        $stmt = $con->prepare($queries[$_GET['key']]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach ($result as $key => $value) {
            echo "<p>$key ： $value</p>";
        }
    }
} else {
    echo '<center><h1>无可奉告</h1></center>';
}
?>

<center><button class="btn waves-effect waves-light" onclick="location.reload()">刷新</button></center>
</body>
</html>

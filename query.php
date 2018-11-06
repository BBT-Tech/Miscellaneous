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
$queries = [
    '18ddp' => 'SELECT COUNT(*) AS 总人数, COUNT(IF(gender = 1, 1, NULL)) AS 男生, COUNT(IF(gender = 0, 1, NULL)) AS 女生 FROM dbname.users'
];

if (!isset($_GET['key'])) exit('<center><h1>无可奉告</h1></center>');
$key = $_GET['key'];
if (!array_key_exists($key, $queries)) exit('<center><h1>没听过</h1></center>');

$con = new PDO("mysql:host=localhost;charset=utf8", 'USERNAME', 'PASSWORD');
$res = $con->query($queries[$key])->fetch(PDO::FETCH_NAMED);
foreach ($res as $k => $v) echo "<p>$k ： $v</p>";
?>

<center><button class="btn waves-effect waves-light" onclick="location.reload()">刷新</button></center>
</body>
</html>

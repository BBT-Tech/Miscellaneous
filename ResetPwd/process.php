<?php
require_once 'config.php';

if (!(isset($_SERVER['PHP_AUTH_USER'])
&& $_SERVER['PHP_AUTH_USER'] == Config::$auth['user']
&& $_SERVER['PHP_AUTH_PW'] == Config::$auth['pwd'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');

    header('HTTP/1.0 401 Unauthorized');

    die('
        <center>
            <p>但是呢 我一句话都不给你看也不好</p>
            <p>你们也不高兴 那怎么办</p>
            <p>我讲的意思 不是说我不让你访问</p>
            <p>但是访问也要按照基本法</p>
            <p>按照正确的用户名和密码</p>
            <p>识得唔识得啊？</p>
        </center>
    ');
}

if (isset($_GET['stuno'])) {
    $conf = Config::$db;
    $host = $conf['host']; $dbname = $conf['database'];
    $username = $conf['username']; $password = $conf['password'];

    $con = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    if (isset($_GET['reset'])) {
        $stmt = $con->prepare(Config::$sql['reset']);
        $stmt->execute([$_GET['stuno']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $n = $stmt->rowCount();
        echo '
            <center>
                <h3>操作成功</h3>
                <h5>'. $n . ' Row Affected</h5>
            </center>
        ';
    } else {
        $stmt = $con->prepare(Config::$sql['select']);
        $stmt->execute([$_GET['stuno']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo '
                <p>姓名：' . $result['name'] . '</p>
                <p>性别：' . $result['sex'] . '</p>
                <p>部门：' . $result['dep'] . '</p>
                <p>组别：' . $result['grp'] . '</p>
                <p>学院：' . $result['college'] . '</p>
                <p>专业：' . $result['major'] . '</p>
            ';
        } else {
            echo '<center><h3>（查无此人）</h3></center>';
        }
    }
}

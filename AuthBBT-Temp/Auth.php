<?php
require_once 'config.php';

class Auth
{
    private function getData($sql, $params =[]) {
        $conf = Config::$db;
        $host = $conf['host']; $dbname = $conf['database'];
        $username = $conf['username']; $password = $conf['password'];

        $con = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

        $stmt = $con->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function test() {
        return $this->getData(Config::$sql['test']);
    }
}

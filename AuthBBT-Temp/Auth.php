<?php
require_once 'config.php';

class AuthBBT
{
    private static function errRes($errcode, $errmsg) {
        return json_encode([
            'errcode' => $errcode,
            'errmsg' => $errmsg
        ]);
    }

    private static function sucRes($user) {
        return json_encode([
            'errcode' => 0,
            'data' => array_diff($user, array_flip(
                ['isActivated', 'isCompleted' ,'isDeleted']
            ))
        ]);
    }

    private static function getData($sql, $params =[]) {
        $conf = Config::$db;
        $host = $conf['host']; $dbname = $conf['database'];
        $username = $conf['username']; $password = $conf['password'];

        $con = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

        $stmt = $con->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function auth($key, $stuno, $password) {
        if (!in_array($key, Config::$granted_keys)) return self::errRes(2333, '吔屎啦你！');

        $salt = Config::$salt;
        $user = self::getData(
            Config::$sql,
            [$stuno, sha1("$salt$password")]
        );

        if (!$user) return self::errRes(1, '用户名或密码错误');
        if ($user['isDeleted']) return self::errRes(2, '很抱歉，你的账号目前已被删除，如有疑问请咨询所在部门的部长~');
        if (!$user['isActivated']) return self::errRes(3, '唔= = 你的账号还没有被激活，请咨询所在部门的部长');

        if (!$user['isCompleted']) return self::errRes(-1, '很抱歉，你的个人信息没有填写完整，先到人员管理系统完善它吧');
        if (!$user['email']) return self::errRes(-2, '唔= = 你的账号没有填写有效的邮箱，快去人员管理系统设置吧');

        if ($stuno == $password || $password == '123456')
            return self::errRes(-3, '唔= = 请先到人员管理系统更改默认密码');

        return self::sucRes($user);
    }
}

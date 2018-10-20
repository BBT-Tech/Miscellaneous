<?php
header('Content-Type: application/json');





// 以下代码用于测试，仅作为结构和部分写法的参考
if (rand() % 3) {
    $result = [
        'errcode' => 233,
        'errmsg' => '吔屎啦你！',
        'data' => ''
    ];
} else {
    $result = [
        "errcode" => 0,
        "errmsg" => "",
        "data" => []
    ];
}

echo json_encode($result);

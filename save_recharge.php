<?php

// save_recharge.php

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

// استقبال البيانات من POST

$input = file_get_contents('php://input');

$data = json_decode($input, true);

if ($data && isset($data['history'])) {

    file_put_contents('recharge_data.json', json_encode($data['history'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo json_encode(["message" => "تم الحفظ بنجاح"]);

} else {

    http_response_code(400);

    echo json_encode(["message" => "بيانات غير صالحة"]);

}

?>
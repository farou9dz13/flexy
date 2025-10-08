<?php
// save_check_states.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// استقبال البيانات من POST
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if ($data && isset($data['checkStates'])) {
    file_put_contents('check_states.json', json_encode($data['checkStates'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo json_encode(["message" => "تم حفظ حالة التحديد بنجاح"]);
} else {
    http_response_code(400);
    echo json_encode(["message" => "بيانات غير صالحة"]);
}
?>
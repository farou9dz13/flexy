<?php

// add_recharge.php

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

$time = $_GET['time'] ?? '';

$amount = $_GET['amount'] ?? '';

// سجل البيانات في ملف log

file_put_contents('api_log.txt', date('Y-m-d H:i:s') . " - Time: $time, Amount: $amount\n", FILE_APPEND);

if (empty($time) || empty($amount)) {

    http_response_code(400);

    echo json_encode(["message" => "بيانات ناقصة"]);

    exit;

}

// قراءة البيانات الحالية

$filename = 'recharge_data.json';

$current_data = [];

if (file_exists($filename)) {

    $json_data = file_get_contents($filename);

    $current_data = json_decode($json_data, true) ?: [];

}

// إنشاء السجل الجديد

$new_record = [

    'id' => count($current_data) + 1,

    'time' => $time,

    'amount' => $amount

];

// إضافة السجل الجديد في البداية

array_unshift($current_data, $new_record);

// حفظ البيانات

if (file_put_contents($filename, json_encode($current_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {

    echo json_encode(["message" => "credit added successfully"]);

} else {

    http_response_code(500);

    echo json_encode(["message" => "there was an error adding credit"]);

}

?>
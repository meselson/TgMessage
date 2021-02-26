<?php
header('content-type: application/json');

$key = $_REQUEST['key'] ?? '';

if ($key !== $_ENV['key']) {
    echo json_encode(['code' => 422, 'message' => 'key error']);
} else {
    //开始设置回调url
    $url = $_REQUEST['url'] ?? $_ENV['url'];
    require_once 'Bot.php';
    $data = ['url' => $url];
    $bot = new Bot();
    $ret = $bot->setWebHook($data);
    if ($ret['ok']) {
        echo json_encode(['code' => 200, 'message' => 'config success']);
    } else {
        echo json_encode(['code' => 422, 'message' => $ret['description']]);
    }
}

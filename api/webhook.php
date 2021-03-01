<?php
header('content-type: application/json');
require_once 'Bot.php';
$bot = new Bot();
// 获取/token 命令，获取聊天 id
$data = json_decode(file_get_contents("php://input"), true);
$chat_id = $data['message']['chat']['id'];
$message = $data['message']['text'] ?? '';
if ($message === '/token') {
    $bot->sendMessage(['text' => $bot->encryption($chat_id), 'chat_id' => $chat_id]);
} elseif ($message === '/help') {
    $bot->sendMessage(['text' => '1. 发送 /token 获取个人token\n2. 请求地址 https://tgpush.vercel.app/api\n3. 调用方式 HTTP get post\n4. get构建方式 https://tgpush.vercel.app/api?token=自己获取的token&message=推送信息', 'chat_id' => $chat_id]);
} else {
    $bot->sendMessage(['text' => 'TG君没有理解您的信息！', 'chat_id' => $chat_id]);
}
echo json_encode(['code' => 200, 'message' => 'success']);

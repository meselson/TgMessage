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
} elseif ($message === '/help' || $message === '/start') {
    $bot->sendMessage(['text' => "1. 发送 /token 获取个人token\n2. 请求地址 https://tgpush.vercel.app/api\n3. 调用方式 HTTP get post\n4. get构建方式 https://tgpush.vercel.app/api?token=".$bot->encryption($chat_id)."&message=推送信息\n5. 消息如需换行，请在需换行内容之间添加 %0A", 'chat_id' => $chat_id]);
} else {
    $bot->sendMessage(['text' => "请求下面网址即可推送消息：\nmessage消息建议进行UrlEncode\n"."https://tgpush.vercel.app/api?token=".$bot->encryption($chat_id)."&message=测试信息", 'chat_id' => $chat_id]);
}
echo json_encode(['code' => 200, 'message' => 'success']);

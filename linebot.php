<?php

$access_token = 'ORSasj1dOJo4XjBr0hIvxvY3hKu7528LZHtpJVTp+ciNyB2sz/IsLYJiuovxgoAuTEL0BhxEtJgv1bvDTp5n6dUxQnfnkXyEQJwQKfsfY6+gE2vXfsS/LQh7gWpPGIx6AEeWP/faP0ttccXucKd8wwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v2/bot/message/reply';

// ユーザーからのメッセージ取得
$raw = file_get_contents('php://input');
$receive = json_decode($raw, true);

// 取得データ
$event = $receive['events'][0];
$reply_token  = $event['replyToken'];	// 返信用トークン
$message_text = $event['message']['text'];	//メッセージ内容

// 現在時刻取得
$now = date("Y/m/d H:i");

$random = rand(0, 480);

if($message_text == "百合"){	// メッセージ内容が「百合」なら以下を実行

// build request headers
$headers = array('Content-Type: application/json',
                 'Authorization: Bearer ' . $access_token);

// build request body
// ここから
$message1 = array('type' => 'text',
                 'text' => $now);

$message2 = array('type' => 'image',
                 'originalContentUrl' => 'https://kenserver.wjg.jp/image/yuri/' . $random . '.jpg',
                 'previewImageUrl'    => 'https://kenserver.wjg.jp/image/yuri/' . $random . '.jpg');

$body = json_encode(array('replyToken' => $reply_token,
                          'messages'   => array($message1,$message2)));

// ここまでをいじって好きな機能を作ろう！

// post json with curl
$options = array(CURLOPT_URL            => $url,
                 CURLOPT_CUSTOMREQUEST  => 'POST',
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_HTTPHEADER     => $headers,
                 CURLOPT_POSTFIELDS     => $body);

$curl = curl_init();
curl_setopt_array($curl, $options);
curl_exec($curl);
curl_close($curl);


} elseif ($message_text == "ロリ") {

$headers = array('Content-Type: application/json',
                 'Authorization: Bearer ' . $access_token);

// ここから
$message1 = array('type' => 'text',
                 'text' => "お前が作れ");

$body = json_encode(array('replyToken' => $reply_token,
                          'messages'   => array($message1)));

// ここまでをいじって好きな機能を作ろう！

// post json with curl
$options = array(CURLOPT_URL            => $url,
                 CURLOPT_CUSTOMREQUEST  => 'POST',
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_HTTPHEADER     => $headers,
                 CURLOPT_POSTFIELDS     => $body);

$curl = curl_init();
curl_setopt_array($curl, $options);
curl_exec($curl);
curl_close($curl);
};

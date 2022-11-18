<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    //
    public function Telegram(Request $request)
    {
        $telegram = new Api('5499424135:AAGg9IveJvvSBWL3gZo6FQLOSKEUKruPgOw');
        $updates = $telegram->getWebhookUpdates();

        $username = $updates['message']['chat']['username'];
        $userid = $updates['message']['chat']['id'];
        $text = $updates['message']['text'];
        $api_key = explode(' ', $text);
        if (!empty($api_key[1])) {
            $telegram->sendMessage([
                'chat_id' => $userid,
                'text' => "[테스트 가맹점] $username($userid) $api_key[1] 님 등록되었습니다",
            ]);
        } else {
            $telegram->sendMessage([
                'chat_id' => $userid,
                'text' => "등록되지 않은 명령어 입니다.",
            ]);
        }
    }
}

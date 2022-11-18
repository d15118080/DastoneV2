<?php

namespace App\Http\Controllers;

use App\Models\Telegarm_set;
use App\Models\User;
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
        if (substr($text, 0, 4) == "/set") {
            $key = substr($text, 5);

            if (Telegarm_set::where('ck_id', $key)->exists()) {
                $telegram->sendMessage([
                    'chat_id' => $userid,
                    'text' => "이미 등록되어 있습니다 관리자에게 문의 하세요.",
                ]);

            } else {

                if (User::where('ck_id', $key)->exists()) {
                    Telegarm_set::insert([
                        'ck_id' => $key,
                        'chat_id' => $userid,
                    ]);
                    $user_name = User::where('ck_id', $key)->value('user_name');
                    $telegram->sendMessage([
                        'chat_id' => $userid,
                        'text' => "[$user_name] 님 알림 등록되었습니다",
                    ]);
                } else {
                    $telegram->sendMessage([
                        'chat_id' => $userid,
                        'text' => "등록되지 않은 유저 입니다.",
                    ]);

                }

            }

        }
    }
}

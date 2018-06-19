<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram;

class TelegramController extends Controller
{
    public function receive(Request $request)
    {
        $json = $request->getContent();
        $info = json_decode($json, true);

        $message = array();
        $message['chat_id']='-1001319789908';
        $message['text']=$json;
        Telegram::sendMessage($message);
    }

    public function test()
    {
        // $message = array();
        // $message['url']='https://telegrambot.cryptovationx.io/webhooks';
        $x = Telegram::getWebhookInfo([]);
        dd($x);

        // $message = array();
        // $message['chat_id']='527317977';
        // $message['text']='Hello';
        // Telegram::sendMessage($message);
    }
}

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

        $msg = array();
        $msg['username'] = $info['message']['from']['username'];
        $msg['firstname'] = $info['message']['from']['first_name'];
        $msg['lastname'] = $info['message']['from']['last_name'];
        $msg['bot'] = $info['message']['from']['is_bot'];
        $msg['text'] = $info['message']['text'];

        $message = array();
        $message['chat_id']='-1001319789908';
        $message['text']= "Sender: ".$msg['firstname']." ".$msg['firstname']."\r\nUsername: ".$msg['username']."\r\nใช่ bot เปล่า: ".$msg['bot']."\r\nMessage".$msg['text'];
        Telegram::sendMessage($message);

        // {"update_id":145511648,
        //     "message":{"message_id":30,
        //                 "from":{"id":526634663,"is_bot":false,"first_name":"Matsumoto.","last_name":"CXA","username":"MatsumotoX"},
        //                 "chat":{"id":-1001319789908,"title":"CXABottesting","type":"supergroup"},
        //                 "date":1529445769,"text":"Hi p bot"}}
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

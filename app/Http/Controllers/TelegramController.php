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
        // $msg['username'] = ['message']['from']['username'];
        $msg['firstname'] = $info['message']['from']['first_name'];
        // $msg['bot'] = ['message']['from']['is_bot'];
        // $msg['text'] = ['message']['chat']['text'];

        $message = array();
        $message['chat_id']='-1001319789908';
        $message['text']= "Sender: ".$msg['firstname'];
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

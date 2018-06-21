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

        if (array_key_exists('text', $info['message'])) {
            $type = "text";
        } else {
            if (array_key_exists('new_chat_member', $info['message']) || array_key_exists('new_chat_members', $info['message'])) {
                $type = "join";
            } else {
                if (array_key_exists('left_chat_member', $info['message'])) {
                    $type = "left";
                } else {
                    $type = "unknown\r\nMessage\r\n".$json;
                }
            }
        }

        // $msg = array();
        // $msg['id'] = $info['message']['from']['id'];
        // $msg['username'] = $info['message']['from']['username'];
        // $msg['firstname'] = $info['message']['from']['first_name'];
        // $msg['lastname'] = $info['message']['from']['last_name'];

        // if ($info['message']['from']['is_bot']==false) {
        //     $msg['bot']='false';
        // } else {
        //     $msg['bot']='true';
        // }
        
        // $msg['text'] = $info['message']['text'];

        $message = array();
        $message['chat_id']='-1001319789908';
        $message['text']=$type;
        // $message['text']= "Sender: ".$msg['firstname']." ".$msg['lastname']." (ID:".$msg['id'].")\r\nUsername: ".$msg['username']."\r\nbot?: ".$msg['bot']."\r\nMessage: ".$msg['text'];
        Telegram::sendMessage($message);

        /*---------------Message Layout-----------------*/
        // --------Simple Chat--------------
        // {"update_id":145511648,
        //     "message":{"message_id":30,
        //                 "from":{"id":526634663,"is_bot":false,"first_name":"Matsumoto.","last_name":"CXA","username":"MatsumotoX"},
        //                 "chat":{"id":-1001319789908,"title":"CXABottesting","type":"supergroup"},
        //                 "date":1529445769,
        //                 "text":"Hi p bot"}}
        //--------Invited--------------
        // {"update_id":145511670,
        //     "message":{"message_id":77,
        //                 "from":{"id":526634663,"is_bot":false,"first_name":"Matsumoto.","last_name":"CXA","username":"MatsumotoX"},
        //                 "chat":{"id":-1001319789908,"title":"CXABottesting","type":"supergroup"},
        //                 "date":1529447708,
        //                 "new_chat_participant":{"id":613521920,"is_bot":true,"first_name":"Hellobot","username":"CXOhellobot"},
        //                 "new_chat_member":{"id":613521920,"is_bot":true,"first_name":"Hellobot","username":"CXOhellobot"},
        //                 "new_chat_members":[{"id":613521920,"is_bot":true,"first_name":"Hellobot","username":"CXOhellobot"}]}}
        // //--------Kicked--------------
        // {"update_id":145511669,
        //     "message":{"message_id":76,
        //                 "from":{"id":526634663,"is_bot":false,"first_name":"Matsumoto.","last_name":"CXA","username":"MatsumotoX"},
        //                 "chat":{"id":-1001319789908,"title":"CXABottesting","type":"supergroup"},
        //                 "date":1529447662,
        //                 "left_chat_participant":{"id":613521920,"is_bot":true,"first_name":"Hellobot","username":"CXOhellobot"},
        //                 "left_chat_member":{"id":613521920,"is_bot":true,"first_name":"Hellobot","username":"CXOhellobot"}}}
        //--------Leave--------------
        // {"update_id":145511680,
        //     "message":{"message_id":5,
        //                 "from":{"id":527317977,"is_bot":false,"first_name":"Worakorn","last_name":"Wattanakulchart","username":"WorakornX","language_code":"en-TH"},
        //                 "chat":{"id":-1001237584794,"title":"Waiting for","type":"supergroup"},
        //                 "date":1529449158,
        //                 "left_chat_participant":{"id":527317977,"is_bot":false,"first_name":"Worakorn","last_name":"Wattanakulchart","username":"WorakornX","language_code":"en-TH"},
        //                 "left_chat_member":{"id":527317977,"is_bot":false,"first_name":"Worakorn","last_name":"Wattanakulchart","username":"WorakornX","language_code":"en-TH"}}}
    }

    public function test()
    {


        // $message = array();
        // $message['chat_id']='-1001319789908';
        // $message['text']='Test';
        // // $message['text']= "Sender: ".$msg['firstname']." ".$msg['lastname']." (ID:".$msg['id'].")\r\nUsername: ".$msg['username']."\r\nbot?: ".$msg['bot']."\r\nMessage: ".$msg['text'];
        // Telegram::sendMessage($message);

        $message = array();
        $message['url']='https://telegrambot.cryptovationx.io/webhooks';
        $x = Telegram::setWebhook($message);
        dd($x);

        // $message = array();
        // $message['chat_id']='527317977';
        // $message['text']='Hello';
        // Telegram::sendMessage($message);
    }
}

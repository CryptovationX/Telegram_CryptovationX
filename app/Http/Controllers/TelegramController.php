<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram;

class TelegramController extends Controller
{
    public function receive(Request $request)
    {
        $message = array();
        $message['chat_id']='-1001319789908';
        $message['text']='Hello';
        Telegram::sendMessage($message);
    }

    public function test()
    {
        $message = array();
        $message['chat_id']='-1001319789908';
        $message['text']='Hello';
        Telegram::sendMessage($message);
    }
}

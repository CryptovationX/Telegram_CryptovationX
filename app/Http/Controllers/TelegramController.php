<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram;

class TelegramController extends Controller
{
    public function receive(Request $request)
    {
        $bot = array();
        $bot['chat_id'] = '-284738772';
        $bot['text'] = 'Text received';

        Telegram::sendMessage($bot);
    }

    public function test()
    {
        $message['chat_id']='-284738772';
        $message['text']='Hello';
        Telegram::sendMessage($message);
    }
}

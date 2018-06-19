<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram;

class Test extends Controller
{
    public function test()
    {
        $bot = array();
        $bot['chat_id'] = '-284738772';
        $bot['text'] = 'Hello e Sus';

        Telegram::sendMessage($bot);
    }
}

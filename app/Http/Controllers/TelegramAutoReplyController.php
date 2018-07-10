<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Exception;
use App\Autoreply;

class TelegramAutoReplyController extends Controller
{
    public function test(Request $request)
    {
        $data = array();
        $data = [
                    'chat_id'   => '-1001319789908',
                    'text'      => 'hello'
                    ];
        $message = Telegram::sendMessage($data);
        dd($message);
    }
    public function index()
    {
        return view('autoreply');
    }

    public function store(Request $request)
    {
        $x = new Autoreply;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Exception;

class TelegramBoardcastController extends Controller
{
    public function test(Request $request)
    {
        $file = $request->file;
        $data = array();

        $data = [
                    'chat_id'    => '-1001319789908',
                    'photo' => $file,
                    // 'caption' => $heading."\n".$content,
                    'parse_mode' => 'markdown'
                    ];
        $message = Telegram::sendPhoto($data);
    }
    public function index()
    {
        return view('boardcast');
    }
    public function boardcast(Request $request)
    {
        if ($request->file == null) {
            $heading = "*".$request->heading."*";
            $content = $request->content;
            $data = [
                'chat_id'    => '-1001319789908',
                'text' => $heading."\n".$content,
                'parse_mode' => 'markdown'
                ];
            $message = Telegram::sendMessage($data);
        } else {
            $file = $request->file;
            $type = $request->file->getClientMimeType();
            // $filename= $file->getFilename();
            // $destinationPath = 'uploads';
            // $file->move($destinationPath, $file->getClientOriginalName());
            $heading = "*".$request->heading."*";
            $content = $request->content;
            
            switch ($type) {
               case "image/png":
               case "image/jpg":
               case "image/jpeg":
               $data = array();
                    $data = [
                        'chat_id'    => '-1001319789908',
                        'photo' => $file,
                        'caption' => $heading."\n".$content,
                        'parse_mode' => 'markdown'
                        ];
                    $message = Telegram::sendPhoto($data);
                break;
                case "video/mp4":
                   $data = array();
                   $data = [
                       'chat_id'    => '-1001319789908',
                       'video' => $file,
                       'caption' => $heading."\n".$content,
                       'parse_mode' => 'markdown'
                       ];
                   $message = Telegram::sendVideo($data);
                break;
               default:
                    $data = array();
                    $data = [
                        'chat_id'    => '-1001319789908',
                        'document' => $file,
                        'caption' => $heading."\n".$content,
                        'parse_mode' => 'markdown'
                        ];
                    $message = Telegram::sendDocument($data);
                   break;
           }
           
            // if ($type == "image/png" || $type == "image/jpeg" || $type == "image/jpg") {
            //     $data = array();
            //     $data = [
            //         'chat_id'    => '-1001319789908',
            //         'photo' => $file,
            //         'caption' => $heading."\n".$content,
            //         'parse_mode' => 'markdown'
            //         ];
            //     $message = Telegram::sendPhoto($data);
            // } else {
            //     $data = array();
            //     $data = [
            //         'chat_id'    => '-1001319789908',
            //         'document' => $file,
            //         'caption' => $heading."\n".$content,
            //         'parse_mode' => 'markdown'
            // ];
            //     $message = Telegram::sendDocument($data);
            // }
        }
        return view('boardcast');
    }
}

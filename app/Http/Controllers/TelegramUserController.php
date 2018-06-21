<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TempId;
use App\TelegramUser;
use Exception;

class TelegramUserController extends Controller
{
    public function test()
    {
        $temp = TempId::find(1);

        $users = $this->getUser($temp->temp + 100);
        // dd($users['users']);
        foreach (array_reverse($users['messages']) as $key => $user) {
            if ($user['_']=='messageService') {
                if ($user['action']['_']=='messageActionChatAddUser') {
                    $data = new TelegramUser;
                    $data->telegram_id = $user['action']['users'][0];
                    $data->method = $user['action']['_'];
                    $data->date_join = date('Y-m-d H:i:s', $user['date']);

                    try {
                        $data->save();
                    } catch (Exception $exception) {
                        $errorCode = $exception->errorInfo[1];
                        if ($errorCode == 1062) {
                            $data = TelegramUser::where('telegram_id', $user['action']['users'][0])->first();
                            $data->telegram_id = $user['action']['users'][0];
                            $data->method = $user['action']['_'];
                            $data->date_join = date('Y-m-d H:i:s', $user['date']);
                            $data->rejoin++;
                            $data->save();
                        }
                    }
                } else {
                    if ($user['action']['_']=='messageActionChatJoinedByLink') {
                        $data = new TelegramUser;
                        $data->telegram_id = $user['from_id'];
                        $data->inviter = $user['action']['inviter_id'];
                        $data->method = $user['action']['_'];
                        $data->date_join = date('Y-m-d H:i:s', $user['date']);

                        try {
                            $data->save();
                        } catch (Exception $exception) {
                            $errorCode = $exception->errorInfo[1];
                            if ($errorCode == 1062) {
                                $data = TelegramUser::where('telegram_id', $user['from_id'])->first();
                                $data->telegram_id = $user['from_id'];
                                $data->inviter = $user['action']['inviter_id'];
                                $data->method = $user['action']['_'];
                                $data->date_join = date('Y-m-d H:i:s', $user['date']);
                                $data->rejoin++;
                                $data->save();
                            }
                        }
                    } else {
                        if ($user['action']['_']=='messageActionChatDeleteUser') {
                            $data = TelegramUser::where('telegram_id', $user['action']['user_id'])->first();
                            if (isset($data)) {
                                $data->date_leave = date('Y-m-d H:i:s', $user['date']);
                                $data->save();
                            }
                        }
                    }
                }
            }
        }

        foreach ($users['users'] as $key => $user) {
            $data = TelegramUser::where('telegram_id', $user['id'])->first();
            if (isset($data)) {
                $data->access_hash = (array_key_exists('access_hash', $user)) ? $user['access_hash'] : null;
                $data->is_bot = (array_key_exists('bot', $user)) ? $user['bot'] : null;
                $data->username = (array_key_exists('username', $user)) ? $user['username'] : null;
                $data->firstname = (array_key_exists('first_name', $user)) ? $user['first_name'] : null;
                $data->lastname = (array_key_exists('last_name', $user)) ? $user['last_name'] : null;
                $data->save();
            }
        }
        
        $temp->temp += 100;
        $temp->save();

        echo($temp->temp);

        sleep(120);
        $this->test();
        // dd($user['messages']);
    }
    public function getUser($offset)
    {
        $MadelineProto = new \danog\MadelineProto\API('session.madeline');
        $MadelineProto->start();

        $me = $MadelineProto->get_self();

        \danog\MadelineProto\Logger::log($me);

        $x = $MadelineProto->messages->getHistory(['peer' => 'https://t.me/joinchat/H2472U-8T_UQ9CX-YqgjKg', 'offset_id' => $offset, 'offset_date' => 0, 'add_offset' => 0, 'limit' => 100, 'max_id' => 0, 'min_id' => 0, 'hash' => 0, ]);

        return $x;
    }
}
// messageActionChatDeleteUser

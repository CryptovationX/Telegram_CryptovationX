<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram;
use GuzzleHttp\Client;

class TelegramController extends Controller
{
    public function receive(Request $request)
    {
        $json = $request->getContent();
        $info = json_decode($json, true);

        $user_id = ($info["message"]["from"]["id"]);
        if($user_id == "530371121" or $user_id == "608732218" or $user_id == "527317977" or $user_id == "619149325" or $user_id == "435684060" or $user_id == "474078415" or $user_id == "301298858" or $user_id == "550041200" or $user_id == "471721523" or $user_id == "526634663" or $user_id == "177286367"){
            if (array_key_exists('text', $info['message'])) {
                $type = "text";
            }
            return;
        }else{
            if (array_key_exists('pinned_message', $info['message'])) {
                $type = "pin";
            } else {
                if (array_key_exists('text', $info['message'])) {
                    $type = "text";
                } else {
                    if (array_key_exists('new_chat_member', $info['message']) || array_key_exists('new_chat_members', $info['message'])) {
                        $type = "join";
                        $chat_id = $info['message']['message_id'];
                        $url = "https://api.telegram.org/bot618237523:AAFxmrcA1W8xZO3ykG9xL2UJNouHDDc2WfA/deleteMessage?chat_id=-1001337741301&message_id=$chat_id";
                        $client = new Client(); 
                        $result = $client->get($url);
                    } else {
                        if (array_key_exists('left_chat_member', $info['message'])) {
                            $type = "left";
                            $chat_id = $info['message']['message_id'];
                            $url = "https://api.telegram.org/bot618237523:AAFxmrcA1W8xZO3ykG9xL2UJNouHDDc2WfA/deleteMessage?chat_id=-1001337741301&message_id=$chat_id";
                            $client = new Client(); 
                            $result = $client->get($url);
                        } else {
                            if (array_key_exists('sticker', $info['message'])) {
                                $type = "sticker";
                            } else {
                                if (array_key_exists('photo', $info['message'])) {
                                    $type = "photo";
                                } else {
                                    if (array_key_exists('voice', $info['message'])) {
                                        $type = "voice";
                                        $chat_id = $info['message']['message_id'];
                                        $url = "https://api.telegram.org/bot618237523:AAFxmrcA1W8xZO3ykG9xL2UJNouHDDc2WfA/deleteMessage?chat_id=-1001337741301&message_id=$chat_id";
                                        $client = new Client(); 
                                        $result = $client->get($url);
                                    } else {
                                        if (array_key_exists('video_note', $info['message'])) {
                                            $type = "video";
                                            $chat_id = $info['message']['message_id'];
                                            $url = "https://api.telegram.org/bot618237523:AAFxmrcA1W8xZO3ykG9xL2UJNouHDDc2WfA/deleteMessage?chat_id=-1001337741301&message_id=$chat_id";
                                            $client = new Client(); 
                                            $result = $client->get($url);
                                        } else {
                                            if (array_key_exists('location', $info['message'])) {
                                                $type = "location";
                                                $chat_id = $info['message']['message_id'];
                                                $url = "https://api.telegram.org/bot618237523:AAFxmrcA1W8xZO3ykG9xL2UJNouHDDc2WfA/deleteMessage?chat_id=-1001337741301&message_id=$chat_id";
                                                $client = new Client(); 
                                                $result = $client->get($url);
                                            } else {
                                                if (array_key_exists('document', $info['message'])) {
                                                    $type = "document";
                                                    $chat_id = $info['message']['message_id'];
                                                    $url = "https://api.telegram.org/bot618237523:AAFxmrcA1W8xZO3ykG9xL2UJNouHDDc2WfA/deleteMessage?chat_id=-1001337741301&message_id=$chat_id";
                                                    $client = new Client(); 
                                                    $result = $client->get($url);
                                                } else {
                                                    if (array_key_exists('contact', $info['message'])) {
                                                        $type = "contact";
                                                        $chat_id = $info['message']['message_id'];
                                                        $url = "https://api.telegram.org/bot618237523:AAFxmrcA1W8xZO3ykG9xL2UJNouHDDc2WfA/deleteMessage?chat_id=-1001337741301&message_id=$chat_id";
                                                        $client = new Client(); 
                                                        $result = $client->get($url);
                                                    } else {
                                                        $type = "unknown\r\nMessage\r\n".$json;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
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
    }

    public function test()
    {
        $MadelineProto = new \danog\MadelineProto\API('session.madeline');
        $MadelineProto->start();
        // $MadelineProto->logout();

        // $me = $MadelineProto->get_self();

        // \danog\MadelineProto\Logger::log($me);

        // if (!$me['bot']) {
        //     $MadelineProto->messages->sendMessage(['peer' => '@danogentili', 'message' => "Hi!\nThanks for creating MadelineProto! <3"]);
        //     $MadelineProto->channels->joinChannel(['channel' => '@MadelineProto']);

        //     try {
        //         $MadelineProto->messages->importChatInvite(['hash' => 'https://t.me/joinchat/Bgrajz6K-aJKu0IpGsLpBg']);
        //     } catch (\danog\MadelineProto\RPCErrorException $e) {
        //     }
        // }
        // $x = $MadelineProto->messages->getHistory(['peer' => 'https://t.me/joinchat/H2472U-8T_UQ9CX-YqgjKg', 'offset_id' => 400, 'offset_date' => 0, 'add_offset' => 0, 'limit' => 100, 'max_id' => 0, 'min_id' => 0, 'hash' => 0, ]);

        dd($x);

        // $message = array();
        // $message['chat_id']='-1001319789908';
        // $message['text']='Test';
        // // $message['text']= "Sender: ".$msg['firstname']." ".$msg['lastname']." (ID:".$msg['id'].")\r\nUsername: ".$msg['username']."\r\nbot?: ".$msg['bot']."\r\nMessage: ".$msg['text'];
        // Telegram::sendMessage($message);

        // $message = array();
        // $message['chat_id']='-1001337741301';
        // $message['user_id']='410833241';
        // $x = Telegram::getChatMember($message);
        // dd($x);

        // $message = array();
        // $message['chat_id']='527317977';
        // $message['text']='Hello';
        // Telegram::sendMessage($message);
    }

    
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
        //--------Sticker--------------
        // {"update_id":271683412,
        //     "message":{"message_id":193,
        //                 "from":{"id":527317977,"is_bot":false,"first_name":"Worakorn","last_name":"CXA","username":"WorakornX","language_code":"en-TH"},
        //                 "chat":{"id":-1001319789908,"title":"CXABottesting","type":"supergroup"},
        //                 "date":1529560890,
        //                 "sticker":{"width":510,"height":512,"emoji":"\ud83d\udcaa","set_name":"TelegramGreatMinds","thumb":{"file_id":"AAQFABPqybEyAASsXyohLbHPkA44AQABAg","file_size":2602,"width":89,"height":90},"file_id":"CAADBQADHAADyIsGAAFzjQavel2uswI","file_size":39518}}}
        //--------Pin--------------
        // {"update_id":271683413,
        //     "message":{"message_id":195,
        //         "from":{"id":527317977,"is_bot":false,"first_name":"Worakorn","last_name":"CXA","username":"WorakornX","language_code":"en-TH"},
        //         "chat":{"id":-1001319789908,"title":"CXABottesting","type":"supergroup"},
        //         "date":1529560911,
        //         "pinned_message":{"message_id":193,"from":{"id":527317977,"is_bot":false,"first_name":"Worakorn","last_name":"CXA","username":"WorakornX","language_code":"en-TH"},
        //         "chat":{"id":-1001319789908,"title":"CXABottesting","type":"supergroup"},
        //         "date":1529560890,
        //--------Photo--------------
        // {"update_id":271683417,
        // "message":{"message_id":203,
        //             "from":{"id":527317977,"is_bot":false,"first_name":"Worakorn","last_name":"CXA","username":"WorakornX","language_code":"en-TH"},
        //             "chat":{"id":-1001319789908,"title":"CXABottesting","type":"supergroup"},
        //             "date":1529561007,
        //             "photo":[{"file_id":"AgADBQADb6gxG7HYWFXjxGdwHoDwJ1lN1TIABBjNJzY8dXTExVcBAAEC","file_size":834,"width":90,"height":48},{"file_id":"AgADBQADb6gxG7HYWFXjxGdwHoDwJ1lN1TIABBHoKP8osdpFxlcBAAEC","file_size":11591,"width":320,"height":171},{"file_id":"AgADBQADb6gxG7HYWFXjxGdwHoDwJ1lN1TIABCLh8oOZWm-7yFcBAAEC","file_size":55158,"width":800,"height":427},{"file_id":"AgADBQADb6gxG7HYWFXjxGdwHoDwJ1lN1TIABM380eM9qbstx1cBAAEC","file_size":100634,"width":1280,"height":684}]}}
        //--------Voice--------------
        // {"update_id":271683418,
        //     "message":{"message_id":205,
        //                 "from":{"id":527317977,"is_bot":false,"first_name":"Worakorn","last_name":"CXA","username":"WorakornX","language_code":"en-TH"},
        //                 "chat":{"id":-1001319789908,"title":"CXABottesting","type":"supergroup"},
        //                 "date":1529561021,
        //                 "voice":{"duration":1,"mime_type":"audio/ogg","file_id":"AwADBQADJgADsdhYVfc01ObqFg9_Ag","file_size":2889}}}
        //--------Video--------------
        // {"update_id":271683422,
        //     "message":{"message_id":213,
        //                 "from":{"id":527317977,"is_bot":false,"first_name":"Worakorn","last_name":"CXA","username":"WorakornX","language_code":"en-TH"},
        //                 "chat":{"id":-1001319789908,"title":"CXABottesting","type":"supergroup"},
        //                 "date":1529561784,
        //                 "video_note":{"duration":2,"length":240,"thumb":{"file_id":"AAQFABOCYdYyAATP8g_ULDx70-8_AAIC","file_size":2340,"width":90,"height":90},
        //                 "file_id":"DQADBQADKAADsdhYVbkDQ7_p99NvAg","file_size":109288}}}
        //--------Location--------------
        // {"update_id":271683424,
        //     "message":{"message_id":217,
        //                 "from":{"id":527317977,"is_bot":false,"first_name":"Worakorn","last_name":"CXA","username":"WorakornX","language_code":"en-TH"},
        //                 "chat":{"id":-1001319789908,"title":"CXABottesting","type":"supergroup"},
        //                 "date":1529561866,
        //                 "location":{"latitude":13.674550,"longitude":100.534625}}}
        //--------Document--------------
        // {"update_id":271683425,
        //     "message":{"message_id":219,
        //                 "from":{"id":527317977,"is_bot":false,"first_name":"Worakorn","last_name":"CXA","username":"WorakornX","language_code":"en-TH"},
        //                 "chat":{"id":-1001319789908,"title":"CXABottesting","type":"supergroup"},
        //                 "date":1529561885,
        //                 "document":{"file_name":"\u0e2b\u0e19\u0e31\u0e07\u0e2a\u0e37\u0e2d\u0e23\u0e31\u0e1a\u0e23\u0e2d\u0e07\u0e01\u0e32\u0e23\u0e1c\u0e48\u0e32\u0e19\u0e07\u0e32\u0e19.pdf","mime_type":"application/pdf","file_id":"BQADBQADKQADsdhYVe_conWOrBsAAQI","file_size":200644}}}
        //--------Contact--------------
        // {"update_id":271683426,
        //     "message":{"message_id":221,
        //                 "from":{"id":527317977,"is_bot":false,"first_name":"Worakorn","last_name":"CXA","username":"WorakornX","language_code":"en-TH"},
        //                 "chat":{"id":-1001319789908,"title":"CXABottesting","type":"supergroup"},
        //                 "date":1529561907,
        //                 "contact":{"phone_number":"0815432345","first_name":"Wundzen \ud83d\udc8e"}}}
}

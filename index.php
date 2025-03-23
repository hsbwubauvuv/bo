<?php

$API_KEY = 'f9LHodD0cOJVCX5yD6M2fsh7_3zPIhMqZwysxAHPISN5Aa8Em3UiWA0iKq4hAROSXkqx3OmMhYi4zXBxZnWELg';// YOUR TOKEN
$tamtam = new tamtam($API_KEY);

class tamtam{
    function __construct($API_KEY)
    {
        $this->token = $API_KEY;
    }
    public function bot($chat,$meh,$data){
        $url = "https://botapi.tamtam.chat/".$meh."?access_token=".$this->token."&chat_id=".$chat;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
        $res = curl_exec($ch);
            return $res;
    }
}


$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->recipient->chat_id;
$text = $message->body->text;

if($text == "/start"){
$tamtam->bot($chat_id,'messages',[
'text'=>"
     

DV : @ALSH_BG
BY : @ALSH_3K
",
]);
}

<?php

$API_KEY = 'f9LHodD0cOJVCX5yD6M2fsh7_3zPIhMqZwysxAHPISN5Aa8Em3UiWA0iKq4hAROSXkqx3OmMhYi4zXBxZnWELg'; // YOUR TOKEN
$tamtam = new tamtam($API_KEY);

class tamtam {
    function __construct($API_KEY) {
        $this->token = $API_KEY;
    }

    public function bot($chat, $method, $data) {
        $url = "https://botapi.tamtam.chat/" . $method . "?access_token=" . $this->token . "&chat_id=" . $chat;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $res = curl_exec($ch);
        return $res;
    }
}

// قراءة الرسائل الواردة عبر POST
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->recipient->chat_id;  // الحصول على chat_id من الرسالة الواردة
$text = $message->body->text;  // استخراج نص الرسالة

// إذا كانت الرسالة "/start"، رد برسالة ترحيبية
if ($text == "/start") {
    $response = $tamtam->bot($chat_id, 'messages', [
        'text' => "مرحباً بك في البوت، يمكنك كتابة أي شيء وسأرد عليك!\n\nDV : @ALSH_BG\nBY : @ALSH_3K"
    ]);
    echo "تم إرسال الرسالة!";
} else {
    // إذا كانت الرسالة نص آخر، رد بنص من البوت
    $response = $tamtam->bot($chat_id, 'messages', [
        'text' => "أنت كتبت: " . $text
    ]);
    echo "تم إرسال رد!";
}

?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بوت تمتم</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>مرحباً بك في بوت تمتم</h2>

<!-- نموذج لكتابة رسالة -->
<input type="text" id="messageInput" placeholder="اكتب هنا...">
<button onclick="sendMessage()">إرسال</button>

<div id="response"></div>

<script>
    function sendMessage() {
        var message = document.getElementById('messageInput').value;
        
        if (message === "") {
            alert("الرجاء إدخال رسالة");
            return;
        }

        // إرسال الرسالة إلى الخادم (الذي يعمل مع API تمتم)
        $.ajax({
            url: '',  // نفس الملف الذي يحتوي على كود PHP
            type: 'POST',
            data: { message: message },
            success: function(response) {
                document.getElementById('response').innerHTML = "الرد من البوت: " + response;
            },
            error: function(error) {
                console.error("حدث خطأ: ", error);
            }
        });
    }
</script>

</body>
</html>

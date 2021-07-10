<?php #INIT
include __DIR__.'/Telegram.php';
define("TOKEN", '===TOKEN===');
$telegram = new Telegram(TOKEN);
$result = $telegram->getData();
$text = strtolower($telegram->Text());
$chat_id = $result['message']['chat']['id'];
$user = $result['message']['chat']['first_name'];
$stck_hello = 'CAACAgIAAxkBAAECSYRgmBfy9k9KV5wpn_xqjLu5HZ1aCgACKgMAAs-71A4f8rUYf2WfMB8E';

#CMD
$cmd_list = "Commands list:
/name - Name
/age - Age
/birth - Date of birth
/country - Country of live
/region - Region of country
/telephone - Telephone number
/telegram - Telegram Contact
/youtube - YouTube channel
/email - Email address
/help - Show this help

Powered by @webulu";

switch($text){
case "id":
  $content = ['chat_id' => $chat_id,'parse_mode' => "HTML", 'text' => "<code>$chat_id</code>"];
  $telegram->sendMessage($content);break;
case "ip":
  $content = ['chat_id' => $chat_id, 'text' => $_SERVER['REMOTE_ADDR']];
  $telegram->sendMessage($content);break;
case "/start":
  file_get_contents('https://api.telegram.org/bot'.TOKEN.'/sendSticker?chat_id='.$chat_id.'&sticker='.$stck_hello);
  $content = ['chat_id' => $chat_id, 'text' => "Hello, $user! ✋\n Enter /help"];
  $telegram->sendMessage($content);break;
case "/name":
  $content = ['chat_id' => $chat_id,'parse_mode' => "HTML", 'text' => "<code>Name Surname</code>"];
  $telegram->sendMessage($content);break;
case "/age":
  $age = (int)date("Y") - 2008;
  $content = ['chat_id' => $chat_id,'parse_mode' => "HTML", 'text' => "<code>$age-year</code>"];
  $telegram->sendMessage($content);break;
case "/birth":
  $content = ['chat_id' => $chat_id,'parse_mode' => "HTML", 'text' => "<code>Date of birthDay</code>"];
  $telegram->sendMessage($content);break;
case "/country":
  $content = ['chat_id' => $chat_id,'parse_mode' => "HTML", 'text' => "<code>Country</code>"];
  $telegram->sendMessage($content);break;
case "/region":
  $content = ['chat_id' => $chat_id,'parse_mode' => "HTML", 'text' => "<code>Region</code>"];
  $telegram->sendMessage($content);break;
case "/telephone":
  $content = ['chat_id' => $chat_id, 'text' => "+xxxxxxxxx"];
  $telegram->sendMessage($content);break;
case "/telegram":
  $content = ['chat_id' => $chat_id,'parse_mode' => "HTML", 'text' => "<a href='http://t.me/webulu'>@webulu</a>"];
  $telegram->sendMessage($content);break;
case "/youtube":
  $content = ['chat_id' => $chat_id,'parse_mode' => "HTML", 'text' => "<a href='https://www.youtube.com/channel/id'>Channel name</a>"];
  $telegram->sendMessage($content);break;
case "/email":
  $content = ['chat_id' => $chat_id,'parse_mode' => "HTML", 'text' => "<a href='mailto:email@gmail.com'>email@gmail.com</a>"];
  $telegram->sendMessage($content);break;
case "/help":
  $option = [
    [$telegram->buildInlineKeyBoardButton("Visit my Web-Site🕸", $url="http://webulu.beget.tech/")]
  ];
  $keyb = $telegram->buildInlineKeyBoard($option);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => $cmd_list];
  $telegram->sendMessage($content);break;
default:
  $content = ['chat_id' => $chat_id, 'text' => "I don't understand this 😢\n --------------\n".$cmd_list];
  $telegram->sendMessage($content);break;
}
?>

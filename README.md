<center>phpmailer</center>


1. > 用法
   >
   > ****
   >
   > ```php
   > $GM = (new \Kaadon\PhpMailer\GmailSender([
   >     "username" => "usdtcloud@gmail.com",
   >     "password" => ""
   > ]));
   > $GM->setTo("kaadon.com@gmail.com")->setText("123456")->Send();
   > ```

   

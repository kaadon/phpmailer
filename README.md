<center>phpmailer</center>



1. > 配置
   > ****
   > 1. > thinkphp配置
   >    >
   >    > ****
   >    >
   >    > ```php
   >    > //在config/kaadon中添加如下配置
   >    >     "phpmailer" => [
   >    >         "gmail" => [
   >    >             "username" => "",
   >    >             "password" => ""
   >    >         ]
   >    >     ]
   >    > // thinkphp中使用 Kaadon\PhpMailer\think\ThinkGmail 类
   >    > // 增加了 sendTemplateVerificationCode 发送方法,使用数据见 example
   >    > ```


2. > 文字用法
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

3. > 模板用法
   >
   > ****
   >
   > ```php
   > $context = [
   >     "server" => [
   >         "member"         => "ipioonet@gmail.com",
   >         "time"         => date("Y-m-d H:i:s"),
   >         "node"           => "韩国",
   >         "ip"             => "103.86.47.17",
   >         "payment_method" => "按月支付",
   >         "payment_price"  => "US$29",
   >     ]
   > ];
   > $GM = (new \Kaadon\PhpMailer\GmailSender([
   >     "username" => "aaaa@gmail.com",
   >     "password" => ""//密码
   > ]));
   > $GM->setTo("aaa@gmail.com")
   >     ->setSubject("服务续费通知")
   >     ->setTwigTemplates("/Volumes/SourceData/composer/phpmailer/twig_templates","product.html",$context)
   >     ->Send()
   > ```

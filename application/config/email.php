<?php
$config['useragent']        = 'PHPMailer';              // Mail engine switcher: 'CodeIgniter' or 'PHPMailer'
$config['protocol']         = 'mail';                   // 'mail', 'sendmail', or 'smtp'
$config['smtp_host']        = 'mx1.hostinger.co.uk';
$config['smtp_user']        = 'support@myraseed.com';
$config['smtp_pass']        = 'Divdas123';
$config['smtp_port']        = 25;
$config['smtp_timeout']     = 5;                        // (in seconds)
$config['smtp_crypto']      = 'tls';                       // '' or 'tls' or 'ssl'
$config['smtp_debug']       = 0;                        // PHPMailer's SMTP debug info level: 0 = off, 1 = commands, 2 = commands and data, 3 = as 2 plus connection 
$config['wordwrap']         = true;
$config['wrapchars']        = 76;
$config['mailtype']         = 'html';                   // 'text' or 'html'
$config['validate']         = true;
$config['priority']         = 3;                        // 1, 2, 3, 4, 5; on PHPMailer useragent NULL is a possible option, it means that X-priority header is not set at 
$config['encoding']         = '8bit';                   // The body encoding. For CodeIgniter: '8bit' or '7bit'. 
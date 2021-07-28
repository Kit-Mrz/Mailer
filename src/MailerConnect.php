<?php

namespace MrzKit\Mailer;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class MailerConnect
{
    /**
     * @var PHPMailer
     */
    protected $mailer;

    /**
     * @var array
     */
    protected $config = [
        // 便于开启调试信息
        'debug'       => false,
        'isSMTP'      => true, //Send using SMTP
        'SMTPAuth'    => true, //Enable SMTP authentication
        'SMTPSecure'  => PHPMailer::ENCRYPTION_SMTPS,
        'SMTPAutoTLS' => false,  // Disable Auto TLS authentication
        'CharSet'     => PHPMailer::CHARSET_UTF8,

        'host'       => '', // Specify main and backup SMTP servers
        'username'   => '', // SMTP username
        'password'   => '',  // SMTP password
        'port'       => 465, // TCP port to connect to
        'timeout'    => 20, // 超时设为20秒
        'exceptions' => true, //Create an instance; passing `true` enables exceptions
    ];

    public function __construct()
    {
        $config = config('mail.mailers.smtp');

        $this->setConfig($config)->createMailer();
    }

    /**
     * @desc 获取配置
     * @return array
     */
    public function getConfig() : array
    {
        return $this->config;
    }

    /**
     * @desc 设置配置
     * @param array $config
     * @return $this
     */
    public function setConfig(array $config)
    {
        $this->config = array_merge($this->config, $config);

        return $this;
    }

    /**
     * @desc 创建邮箱实例
     * @return $this
     */
    public function createMailer()
    {
        $config = $this->getConfig();

        $mail = new PHPMailer($config['exceptions']);

        //Server settings
        $config['isSMTP'] ? $mail->isSMTP() : $mail->isMail();
        $mail->SMTPDebug   = $config['debug'] ? SMTP::DEBUG_LOWLEVEL : SMTP::DEBUG_OFF;
        $mail->SMTPAuth    = $config['SMTPAuth'];
        $mail->SMTPSecure  = $config['SMTPSecure'];
        $mail->SMTPAutoTLS = $config['SMTPAutoTLS'];
        $mail->Host        = $config['host'];
        $mail->Username    = $config['username'];
        $mail->Password    = $config['password'];
        $mail->Port        = $config['port'];
        $mail->Timeout     = $config['timeout'];
        $mail->CharSet     = $config['CharSet'];

        $this->mailer = $mail;

        return $this;
    }

    /**
     * @desc 获取邮箱实例
     * @return PHPMailer
     */
    public function getMailer() : PHPMailer
    {
        return $this->mailer;
    }
}

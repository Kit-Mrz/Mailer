<?php

namespace Mrzkit\Mailer;

use Mrzkit\Mailer\Contracts\ConnectorContract;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class MailConnector implements ConnectorContract
{
    /**
     * @var PHPMailer
     */
    protected $phpMailer;

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

        'host'     => '', // Specify main and backup SMTP servers
        'port'     => 465, // TCP port to connect to
        'username' => '', // SMTP username
        'password' => '',  // SMTP password
        'timeout'  => 20, // 超时设为20秒

        'exceptions' => true, //Create an instance; passing `true` enables exceptions
    ];

    public function __construct(array $config = [])
    {
        $config = empty($config) ? (array) config('mail.mailers.smtp') : $config;

        $this->setConfig($config)->setMailer();
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
    private function setConfig(array $config)
    {
        $this->config['debug']      = (bool) $config['debug'];
        $this->config['host']       = (string) $config['host'];
        $this->config['port']       = (int) $config['port'];
        $this->config['username']   = (string) $config['username'];
        $this->config['password']   = (string) $config['password'];
        $this->config['timeout']    = (int) $config['timeout'];
        $this->config['encryption'] = (bool) $config['encryption'];

        return $this;
    }

    /**
     * @desc 创建邮箱实例
     * @return $this
     */
    public function setMailer()
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

        $this->phpMailer = $mail;

        return $this;
    }

    /**
     * @desc 获取邮箱实例
     * @return PHPMailer
     */
    public function phpMailer() : PHPMailer
    {
        return $this->phpMailer;
    }
}

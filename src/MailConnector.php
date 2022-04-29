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
    protected $config = [];

    public function __construct(array $config = [])
    {
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
        $config = [
            // 便于开启调试信息
            'debug'         => (bool) ($config['debug'] ?? false),
            'exceptions'    => (bool) ($config['exceptions'] ?? true), //Create an instance; passing `true` enables exceptions
            'SMTPAuth'      => (bool) ($config['SMTPAuth'] ?? true), //Enable SMTP authentication
            'SMTPSecure'    => (string) ($config['SMTPSecure'] ?? PHPMailer::ENCRYPTION_SMTPS),
            'SMTPAutoTLS'   => (bool) ($config['SMTPAutoTLS'] ?? false),  // Disable Auto TLS authentication
            'SMTPKeepAlive' => (bool) ($config['SMTPKeepAlive'] ?? true),
            'CharSet'       => (string) ($config['CharSet'] ?? PHPMailer::CHARSET_UTF8),

            'host'     => (string) ($config['host'] ?? ""), // Specify main and backup SMTP servers
            'port'     => (int) ($config['port'] ?? 465), // TCP port to connect to
            'username' => (string) ($config['username'] ?? ""), // SMTP username
            'password' => (string) ($config['password'] ?? ""),  // SMTP password
            'timeout'  => (string) ($config['timeout'] ?? 20), // 超时设为20秒
        ];

        $this->config = $config;

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

        $mail->SMTPDebug     = $config['debug'] ? SMTP::DEBUG_LOWLEVEL : SMTP::DEBUG_OFF;
        $mail->SMTPAuth      = $config['SMTPAuth'];
        $mail->SMTPSecure    = $config['SMTPSecure'];
        $mail->SMTPAutoTLS   = $config['SMTPAutoTLS'];
        $mail->SMTPKeepAlive = $config['SMTPKeepAlive'] ?? true;
        $mail->CharSet       = $config['CharSet'];
        $mail->Host          = $config['host'];
        $mail->Port          = $config['port'];
        $mail->Username      = $config['username'];
        $mail->Password      = $config['password'];
        $mail->Timeout       = $config['timeout'];

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

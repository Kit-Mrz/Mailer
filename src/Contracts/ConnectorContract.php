<?php

namespace Mrzkit\Mailer\Contracts;

use PHPMailer\PHPMailer\PHPMailer;

interface ConnectorContract
{
    /**
     * @desc 获取配置
     * @return array
     */
    public function getConfig() : array;

    /**
     * @desc 获取邮件实例
     * @return PHPMailer
     */
    public function phpMailer() : PHPMailer;
}

<?php

namespace Mrzkit\Mailer\Contracts;

use Mrzkit\Mailer\Mailer;

interface MailProviderContract
{
    /**
     * @desc 配置
     * @return MailConfigContract
     */
    public function getMailConfigContract() : MailConfigContract;

    /**
     * @desc 连接器
     * @return mixed
     */
    public function getConnectorContract() : ConnectorContract;

    /**
     * @desc 实例
     * @return Mailer
     */
    public function getMailer() : Mailer;
}

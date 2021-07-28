<?php

namespace App\Cores\Mailer\Contract;

interface MailGetterContract
{
    // 发件人
    public function getFrom() : array;

    // 收件人
    public function getRecipients() : array;

    // 回复
    public function getReplyTo() : array;

    // 抄送
    public function getCC() : array;

    // 密送
    public function getBCC() : array;

    // 标题
    public function getSubject() : string;

    // 主体
    public function getBody() : string;

    // 附件
    public function getAttachments() : array;

    // HTML
    public function getIsHtml() : bool;
}

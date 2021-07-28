<?php

namespace App\Cores\Mailer\Contract;

interface MailSetterContract
{
    // 发件人
    public function setFrom();

    // 收件人
    public function setRecipients();

    // 回复
    public function setReplyTo();

    // 抄送
    public function setCC();

    // 密送
    public function setBCC();

    // 标题
    public function setSubject();

    // 主体
    public function setBody();

    // 附件
    public function setAttachments();

    // HTML
    public function setIsHTML();

    // 发送
    public function send() : bool;
}

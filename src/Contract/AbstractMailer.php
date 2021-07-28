<?php

namespace App\Cores\Mailer\Contract;

use App\Cores\Mailer\Mailer;
use InvalidArgumentException;

abstract class AbstractMailer implements MailGetterContract, MailSetterContract
{

    /**
     * @var array 发送人 ['address' = '', 'name' => '']
     */
    protected $from = [];

    /**
     * @var array 收件人(可多个) [ ['address' = '', 'name' => ''], ['address' = '', 'name' => ''] ]
     */
    protected $recipients = [];

    /**
     * @var array 邮件回复地址 ['address' = '', 'name' => '']
     */
    protected $replyTo = [];

    /**
     * @var array 抄送人(可多个) [ ['address' = '', 'name' => ''], ['address' = '', 'name' => ''] ]
     */
    protected $cc = [];

    /**
     * @var array 密送人(可多个) [ ['address' = '', 'name' => ''], ['address' = '', 'name' => ''] ]
     */
    protected $bcc = [];

    /**
     * @var string 邮件标题
     */
    protected $subject = '';

    /**
     * @var string 邮件内容
     */
    protected $body = '';

    /**
     * @var array 附件
     */
    protected $attachments = [];

    /**
     * @var bool 是否HTML
     */
    protected $is_html = true;

    public function getFrom() : array
    {
        return $this->from;
    }

    public function getRecipients() : array
    {
        return $this->recipients;
    }

    public function getReplyTo() : array
    {
        return $this->replyTo;
    }

    public function getCC() : array
    {
        return $this->cc;
    }

    public function getBCC() : array
    {
        return $this->bcc;
    }

    public function getSubject() : string
    {
        return $this->subject;
    }

    public function getBody() : string
    {
        return $this->body;
    }

    public function getAttachments() : array
    {
        return $this->attachments;
    }

    public function getIsHtml() : bool
    {
        return $this->is_html;
    }

    public function send() : bool
    {
        $email = new Mailer();

        $from = $this->getFrom();
        $email->setFrom($from['address'], $from['name']);

        $recipients = $this->getRecipients();
        $email->addRecipients($recipients);

        $replyTo = $this->getReplyTo();
        $email->addReplyTo($replyTo['address'], $replyTo['name']);

        $cc = $this->getCC();
        $email->addCC($cc);

        $bcc = $this->getBCC();
        $email->addBCC($bcc);

        $subject = $this->getSubject();
        $email->setSubject($subject);

        $body = $this->getBody();
        $email->setBody($body);

        $attachments = $this->getAttachments();
        $email->addAttachments($attachments);

        $isHtml = $this->getIsHtml();
        $email->isHTML($isHtml);

        return $email->send();
    }

    // 必须
    public function setFrom(array $params = [])
    {
        if ( !isset($params['address'])) {
            throw new InvalidArgumentException('Invalid argument address.');
        }

        $this->from = ['address' => $params['address'], 'name' => $params['name'] ?? ''];

        return $this;
    }

    // 必须
    public function setRecipients(array $params = [])
    {
        foreach ($params as $param) {
            if ( !isset($param['address'])) {
                throw new InvalidArgumentException('Invalid argument address.');
            }

            $this->recipients[] = ['address' => $param['address'], 'name' => $param['name'] ?? ''];
        }

        return $this;
    }

    // 必须
    public function setReplyTo(array $params = [])
    {
        if ( !isset($params['address'])) {
            throw new InvalidArgumentException('Invalid argument address.');
        }

        $this->replyTo = ['address' => $params['address'], 'name' => $params['name'] ?? ''];

        return $this;
    }

    // 可选
    public function setCC(array $params = [])
    {
        foreach ($params as $param) {
            if ( !isset($param['address'])) {
                throw new InvalidArgumentException('Invalid argument address.');
            }

            $this->cc[] = ['address' => $param['address'], 'name' => $param['name'] ?? ''];
        }

        return $this;
    }

    // 可选
    public function setBCC(array $params = [])
    {
        foreach ($params as $param) {
            if ( !isset($param['address'])) {
                throw new InvalidArgumentException('Invalid argument address.');
            }

            $this->bcc[] = ['address' => $param['address'], 'name' => $param['name'] ?? ''];
        }

        return $this;
    }

    // 可选
    public function setAttachments(array $params = [])
    {
        foreach ($params as $param) {
            if ( !isset($param['path'])) {
                throw new InvalidArgumentException('Invalid argument path.');
            }

            $this->attachments[] = [
                'path' => $param['path'],
            ];
        }

        return $this;
    }

    // 可选
    public function setIsHTML(bool $isHtml = true)
    {
        $this->is_html = $isHtml;

        return $this;
    }

    // 必须
    public function setSubject(string $subject = '')
    {
        $this->subject = $subject;

        return $this;
    }

    // 必须
    public function setBody(string $body = '')
    {
        $this->body = $body;

        return $this;
    }
}

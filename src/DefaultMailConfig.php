<?php

namespace Mrzkit\Mailer;

use Mrzkit\Mailer\Contracts\MailConfigContract;

class DefaultMailConfig implements MailConfigContract
{
    private $config;

    public function __construct()
    {
        $this->config = config('mail.mailers.smtp');
    }

    public function getDebug() : bool
    {
        return $this->config['debug'];
    }

    public function getHost() : string
    {
        return $this->config['host'];
    }

    public function getPort() : int
    {
        return $this->config['port'];
    }

    public function getUsername() : string
    {
        return $this->config['username'];
    }

    public function getPassword() : string
    {
        return $this->config['password'];
    }

    public function getTimeout() : int
    {
        return $this->config['timeout'];
    }

    public function getExceptions() : bool
    {
        return $this->config['exceptions'];
    }

    public function getSMTPAuth() : bool
    {
        return $this->config['SMTPAuth'];
    }

    public function getSMTPSecure() : string
    {
        return $this->config['SMTPSecure'];
    }

    public function getSMTPAutoTLS() : bool
    {
        return $this->config['SMTPAutoTLS'];
    }

    public function getSMTPKeepAlive() : bool
    {
        return $this->config['SMTPAutoTLS'];
    }

    public function getCharSet() : string
    {
        return $this->config['CharSet'];
    }
}

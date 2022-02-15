<?php

namespace Mrzkit\Mailer\Contracts;

use PHPMailer\PHPMailer\PHPMailer;

interface ConnectorContract
{
    public function getConfig() : array;

    public function getMailer() : PHPMailer;
}

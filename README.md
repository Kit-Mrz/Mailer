# PHPMailer 封装

# Example

        $ts = new MailTransfer();
        $ts->setFrom($params['from'])
            ->setRecipients($params['recipients'])
            ->setReplyTo($params['replyTo'] ?? $params['from'])
            ->setCC($params['cc'] ?? [])
            ->setBCC($params['bcc'] ?? [])
            ->setSubject()
            ->setBody()
            ->setAttachments($params['attachments'] ?? []);

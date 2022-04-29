# PHPMailer 封装

# Example

````PHP
use Mrzkit\Mailer\MailTransfer;
use Mrzkit\Mailer\Sender;
use Mrzkit\Mailer\MailProvider;
use Mrzkit\Mailer\DefaultMailConfig;

    $mailTransfer = new MailTransfer();
    
    $mailTransfer->setFrom($params['from'])
        ->setRecipients($params['recipients'])
        ->setReplyTo($params['replyTo'] ?? $params['from'])
        ->setCC($params['cc'] ?? [])
        ->setBCC($params['bcc'] ?? [])
        ->setSubject()
        ->setBody()
        ->setAttachments($params['attachments'] ?? []);
        
    $defaultMailConfig = new DefaultMailConfig();

    $defaultMailProvider = new MailProvider($defaultMailConfig);

    $sender = new Sender($mailTransfer, $defaultMailProvider);
    
    $sender->send();
````

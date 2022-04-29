# PHPMailer 封装

# Example

````PHP
use Mrzkit\Mailer\MailTransfer;
use Mrzkit\Mailer\Sender;
use Mrzkit\Mailer\Contracts\DefaultMailProvider;

    $mailTransfer = new MailTransfer();
    $mailTransfer->setFrom($params['from'])
        ->setRecipients($params['recipients'])
        ->setReplyTo($params['replyTo'] ?? $params['from'])
        ->setCC($params['cc'] ?? [])
        ->setBCC($params['bcc'] ?? [])
        ->setSubject()
        ->setBody()
        ->setAttachments($params['attachments'] ?? []);
        
    $defaultMailProvider = new DefaultMailProvider();

    $sender = new Sender($mailTransfer, $defaultMailProvider);
    
    $sender->send();
````

# PHPMailer 封装

# Example

````PHP
use Mrzkit\Mailer\MailTransfer;
use Mrzkit\Mailer\Sender;

    $mailTransfer = new MailTransfer();
    $mailTransfer->setFrom($params['from'])
        ->setRecipients($params['recipients'])
        ->setReplyTo($params['replyTo'] ?? $params['from'])
        ->setCC($params['cc'] ?? [])
        ->setBCC($params['bcc'] ?? [])
        ->setSubject()
        ->setBody()
        ->setAttachments($params['attachments'] ?? []);
        
    $defaultOfferMailer = new DefaultOfferMailer();

    $sender = new Sender($mailTransfer, $defaultOfferMailer);
    
    $sender->send();
````

<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 6/25/2018
 * Time: 6:15 PM
 */
namespace frontend\services\contact;

use frontend\forms\ContactForm;
use RuntimeException;
use Yii;
use yii\mail\MailerInterface;

class ContactService
{
    private $adminEmail;
    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * ContactService constructor.
     * @param $adminEmail
     * @param MailerInterface $mailer
     */
    public function __construct( $adminEmail, MailerInterface $mailer)
    {
        $this->adminEmail = $adminEmail;
        $this->mailer = $mailer;
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param ContactForm $form
     * @return void whether the email was sent
     */
    public function send(ContactForm $form): void
    {
        $sent = $this->mailer->compose()
            ->setFrom($form->email)
            ->setTo($this->adminEmail)
            ->setSubject($form->subject)
            ->setTextBody($form->body)
            ->send();

        if (!$sent) {
            throw new RuntimeException('Sending Error.');
        }
    }
}
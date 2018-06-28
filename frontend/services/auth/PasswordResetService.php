<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 6/25/2018
 * Time: 1:59 PM
 */

namespace frontend\services\auth;


use common\entities\User;
use common\repositories\UserRepository;
use DomainException;
use frontend\forms\PasswordResetRequestForm;
use frontend\forms\ResetPasswordForm;
use Yii;
use yii\mail\MailerInterface;

class PasswordResetService
{
    public $email;
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * PasswordResetService constructor.
     * @param MailerInterface $mailer
     * @param UserRepository $userRepository
     */
    public function __construct(MailerInterface $mailer, UserRepository $userRepository)
    {

        $this->mailer = $mailer;
        $this->userRepository = $userRepository;
    }
    /**
     * @param PasswordResetRequestForm $form
     * @throws \yii\base\Exception
     */
    public function request(PasswordResetRequestForm $form): void
    {
        $user = $this->userRepository->getByEmail($form->email);
        $user->requestPasswordReset();
        $this->userRepository->save($user);
        $sent = $this
            ->mailer
            ->compose(
                [
                    'html' => 'passwordResetToken-html',
                    'text' => 'passwordResetToken-text'
                ],
                ['user' => $user]
            )
            ->setTo($user->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
        if (!$sent) {
            throw new \RuntimeException('Sending Error');
        }
    }
    /**
     * @param $token
     */
    public function validateToken($token): void
    {
        if (empty($token) || !is_string($token)) {
            throw new DomainException('Password reset token cannon be blank');
        }
        if (!$this->userRepository->existsByPasswordResetToken($token)) {
            throw new DomainException('Wrong password reset token');
        }
    }
    /**
     * @param string $token
     * @param ResetPasswordForm $form
     * @throws \yii\base\Exception
     */
    public function reset(string $token, ResetPasswordForm $form): void
    {
        $user = $this->userRepository->getByPasswordResetToken($token);
        $user->resetPassword($form->password);
        $this->userRepository->save($user);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 6/25/2018
 * Time: 1:59 PM
 */

namespace core\useServices\auth;

use core\repositories\UserRepository;
use DomainException;
use core\forms\auth\PasswordResetRequestForm;
use core\forms\auth\ResetPasswordForm;
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
     * @param \core\forms\auth\PasswordResetRequestForm $form
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
                    'html' => 'auth/reset/confirm-html',
                    'text' => 'auth/reset/confirm-text'
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
     * @param \core\forms\auth\ResetPasswordForm $form
     * @throws \yii\base\Exception
     */
    public function reset(string $token, ResetPasswordForm $form): void
    {
        $user = $this->userRepository->getByPasswordResetToken($token);
        $user->resetPassword($form->password);
        $this->userRepository->save($user);
    }
}
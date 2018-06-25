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
use DomainException;
use frontend\forms\PasswordResetRequestForm;
use frontend\forms\ResetPasswordForm;
use Yii;

class PasswordResetService
{
    public $email;


    /**
     * @param PasswordResetRequestForm $form
     * @throws \yii\base\Exception
     */
    public function request(PasswordResetRequestForm $form): void
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $form->email,
        ]);


        if (!$user) {
            throw new DomainException('User is not found.');
        }

        $user->requestPasswordReset();

        if (!$user->save()) {
            throw new \RuntimeException('Saving error');
        }

        $sent = Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
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
        if (!User::findByPasswordResetToken($token)) {
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
        $user = User::findByPasswordResetToken($token);

        if (!$user) {
            throw new DomainException('User is not found. ');
        }

        $user->resetPassword($form->password);

        if (!$user->save()) {
            throw new \RuntimeException('Saving Error');
        }
    }


}
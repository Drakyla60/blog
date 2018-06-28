<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 6/25/2018
 * Time: 12:57 PM
 */
namespace frontend\services\auth;

use common\entities\User;
use common\repositories\UserRepository;
use frontend\forms\SignupForm;
use Yii;
use yii\helpers\VarDumper;
use yii\mail\MailerInterface;

/**
 * Class SignUpService
 * @package frontend\services
 */
class SignUpService
{
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * SignUpService constructor.
     * @param MailerInterface $mailer
     * @param UserRepository $userRepository
     */
    public function __construct(MailerInterface $mailer, UserRepository $userRepository)
    {

        $this->mailer = $mailer;
        $this->userRepository = $userRepository;
    }

    /**
     * @param SignupForm $form
     * @return void
     * @throws \yii\base\Exception
     */
    public function signup(SignupForm $form): void
    {
        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password
        );

        $this->save($user);

        $sent = $this->mailer
            ->compose(
                ['html' => 'emailConfirmToken-html', 'text' => 'emailConfirmToken-text'],
                ['user' =>$user]
            )
            ->setTo($form->email)
            ->setSubject('SignUp confirm for '. Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Email sending error.');
        }
    }

    /**
     * @param $token
     */
    public function confirm($token): void
    {
        if (empty($token)) {
            throw new \DomainException('Empty confirm token');
        }

        $user = $this->userRepository->getByEmailConfirmToken($token);
        $user->confirmSignUp();
        $this->save($user);
    }



    public function save( User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
}
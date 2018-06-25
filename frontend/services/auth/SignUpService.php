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
use frontend\forms\SignupForm;

/**
 * Class SignUpService
 * @package frontend\services
 */
class SignUpService
{
    /**
     * @param SignupForm $form
     * @return User
     * @throws \yii\base\Exception
     */
    public function signup(SignupForm $form):User
    {
        $user = User::signup($form->username, $form->email, $form->password);

        if (!$user->save()) {
            throw new \RuntimeException('Saving error');
        }
        return $user;
    }
}
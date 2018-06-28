<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 6/28/2018
 * Time: 1:16 PM
 */

namespace frontend\services\auth;

use common\entities\User;
use common\forms\LoginForm;
use common\repositories\UserRepository;

class AuthService
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param LoginForm $form
     * @return User
     */
    public function auth(LoginForm $form): User
    {
        $user = $this->userRepository->findByUsernameOrEmail($form->username);
        if (!$user || !$user->isActive() || !$user->validatePassword($form->password)) {
            throw new \DomainException('Undefined user or email.');
        }
        return $user;
    }
}
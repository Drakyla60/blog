<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/9/2018
 * Time: 12:39 PM
 */

namespace core\useServices\manage;


use core\entities\User\User;
use core\forms\manage\User\UserCreateForm;
use core\forms\manage\User\UserEditForm;
use core\repositories\UserRepository;

class UserManageService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserCreateForm $form
     * @return User
     * @throws \yii\base\Exception
     */
    public function create(UserCreateForm $form): User
    {
        $user = User::create(
            $form->username,
            $form->email,
            $form->password
        );
        $this->userRepository->save($user);
        return $user;
    }

    public function edit($id, UserEditForm $userEditForm): void
    {
        $user = $this->userRepository->get($id);
        $user->edit(
            $userEditForm->username,
            $userEditForm->email
        );
        $this->userRepository->save($user);
    }
}
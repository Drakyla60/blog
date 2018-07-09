<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 6/28/2018
 * Time: 11:05 AM
 */
namespace core\repositories;

use core\entities\User;
/**
 * Class UserRepository
 * @package common\repositories
 */
class UserRepository
{
    /**
     * @param $value
     * @return array|User|\yii\db\ActiveRecord
     */
    public function findByUsernameOrEmail($value)
    {
        return User::find()->andWhere(['or', ['username' => $value], ['email' => $value]])->one();
    }

    public function get($id): User
    {
        return $this->getBy(['id' => $id]);
    }

    /**
     * @param string $token
     * @return User
     */
    public function getByEmailConfirmToken(string $token): User
    {
        return $this->getBy(['email_confirm_token' => $token]);
    }

    /**
     * @param string $email
     * @return User
     */
    public function getByEmail(string $email): User
    {
        return $this->getBy(['email' => $email]);
    }

    /**
     * @param string $token
     * @return User
     */
    public function getByPasswordResetToken(string $token): User
    {
        return $this->getBy(['password_reset_token' => $token]);
    }

    /**
     * @param string $token
     * @return bool
     */
    public function existsByPasswordResetToken (string $token): bool
    {
        return (bool) User::findByPasswordResetToken($token);
    }

    /**
     * @param User $user
     */
    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving Error');
        }
    }

    /**
     * @param array $condition
     * @return array|\core\entities\User|\yii\db\ActiveRecord
     */
    public function getBy(array $condition)
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('User is not found');
        }
        return $user;
    }



}
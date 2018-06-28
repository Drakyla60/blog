<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 1/17/2018
 * Time: 9:23 PM
 */
/* @var $this yii\web\View */
/* @var $user \core\entities\User */
$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup/confirm', 'token' => $user->email_confirm_token]);
?>
    Hello <?= $user->username ?>,

    Follow the link below to confirm your email:

<?= $confirmLink ?>
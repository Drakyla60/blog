<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 6/27/2018
 * Time: 9:17 PM
 */
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\entities\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>

Hello <?= $user->username ?>,

Follow the link below to confirm your email:

<p><?= $resetLink ?></p>

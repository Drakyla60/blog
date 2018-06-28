<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 6/27/2018
 * Time: 9:09 PM
 */

use yii\helpers\Html;

/** @var $this yii\web\View */
/** @var $user \core\entities\User */
$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['site/confirm', 'token' => $user->email_confirm_token]);
?>

<div class="password-reset">
    <p> Hello <?= Html::encode($user->username)?>, </p>

    <p> Follow the link below to confirm your email: </p>

    <p> <?= Html::a(Html::encode($confirmLink), $confirmLink)?></p>
</div>


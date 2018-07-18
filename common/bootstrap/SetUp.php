<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 6/24/2018
 * Time: 1:39 PM
 */
namespace  common\bootstrap;

use core\useServices\auth\PasswordResetService;
use core\useServices\contact\ContactService;
use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\mail\MailerInterface;

class SetUp implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app): void
    {
        $container = Yii::$container;

        $container->setSingleton(PasswordResetService::class);

        $container->setSingleton(ContactService::class, [], [
           $app->params['adminEmail']
        ]);

        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });
    }
}
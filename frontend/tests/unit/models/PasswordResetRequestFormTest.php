<?php

namespace frontend\tests\unit\models;

use PHPUnit\Framework\TestResult;
use Yii;
use frontend\forms\PasswordResetRequestForm;
use common\fixtures\UserFixture as UserFixture;
use common\entities\User;

 class PasswordResetRequestFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;


    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    public function testSendMessageWithWrongEmailAddress()
    {
        $model = new PasswordResetRequestForm();
        $model->email = 'not-existing-email@example.com';
        expect_not($model->sendEmail());
    }

    public function testNotSendEmailsToInactiveUser()
    {
        $user = $this->tester->grabFixture('user', 1);
        $model = new PasswordResetRequestForm();
        $model->email = $user['email'];
        expect_not($model->sendEmail());
    }

    public function testSendEmailSuccessfully()
    {
        $userFixture = $this->tester->grabFixture('user', 0);
        
        $model = new PasswordResetRequestForm();
        $model->email = $userFixture['email'];
        $user = User::findOne(['password_reset_token' => $userFixture['password_reset_token']]);

        expect_that($model->sendEmail());
        expect_that($user->password_reset_token);

        $emailMessage = $this->tester->grabLastSentEmail();
        expect('valid email is sent', $emailMessage)->isInstanceOf('yii\mail\MessageInterface');
        expect($emailMessage->getTo())->hasKey($model->email);
        expect($emailMessage->getFrom())->hasKey(Yii::$app->params['supportEmail']);
    }

     /**
      * Count elements of an object
      * @link http://php.net/manual/en/countable.count.php
      * @return int The custom count as an integer.
      * </p>
      * <p>
      * The return value is cast to an integer.
      * @since 5.1.0
      */
     public function count()
     {
         // TODO: Implement count() method.
     }

     /**
      * Runs a test and collects its result in a TestResult instance.
      *
      * @param TestResult $result
      *
      * @return TestResult
      */
     public function run(TestResult $result = null)
     {
         // TODO: Implement run() method.
     }
 }

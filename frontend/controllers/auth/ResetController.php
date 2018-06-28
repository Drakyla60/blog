<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 6/28/2018
 * Time: 3:42 PM
 */

namespace frontend\controllers\auth;


use core\forms\auth\PasswordResetRequestForm;
use core\forms\auth\ResetPasswordForm;
use core\useServices\auth\PasswordResetService;
use frontend\controllers\BasesController;
use Yii;
use yii\web\BadRequestHttpException;

/**
 * Class ResetController
 * @package frontend\controllers\auth
 */
class ResetController extends BasesController
{
    /**
     * @var PasswordResetService
     */
    private $passwordResetService;

    /**
     * ResetController constructor.
     * @param $id
     * @param $module
     * @param PasswordResetService $passwordResetService
     * @param array $config
     */
    public function __construct($id, $module,
                                PasswordResetService $passwordResetService,
                                array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->passwordResetService = $passwordResetService;
    }


    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionRequest()
    {
        $form = new PasswordResetRequestForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try{
                $this->passwordResetService->request($form);
                Yii::$app->session->setFlash('success',
                    'Check your email for further instructions.');
                return $this->goHome();
            }catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $form,
        ]);
    }

    /**
     * @param $token
     * @return string|\yii\web\Response
     * @throws BadRequestHttpException
     * @throws \yii\base\Exception
     */
    public function actionConfirm($token)
    {
        try {
            $this->passwordResetService->validateToken($token);
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        $form = new ResetPasswordForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->passwordResetService->reset($token, $form);
                Yii::$app->session->setFlash('success', 'New password saved');
                return $this->goHome();
            }catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());

            }
        }

        return $this->render('resetPassword', [
            'model' => $form,
        ]);
    }
}
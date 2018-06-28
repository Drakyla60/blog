<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 6/28/2018
 * Time: 3:38 PM
 */

namespace frontend\controllers\auth;


use core\forms\auth\LoginForm;
use core\useServices\auth\AuthService;
use frontend\controllers\BasesController;
use Yii;

/**
 * Class AuthController
 * @package frontend\controllers\auth
 */
class AuthController extends BasesController
{
    /**
     * @var AuthService
     */
    private $authService;

    /**
     * AuthController constructor.
     * @param $id
     * @param $module
     * @param AuthService $authService
     * @param array $config
     */
    public function __construct($id, $module,
                                AuthService $authService,
                                array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->authService = $authService;
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) return $this->goHome();

        $form = new LoginForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $user = $this->authService->auth($form);
                Yii::$app->user->login($user, $form->rememberMe ? 3600 * 24 * 30 : 0);
                return $this->goBack();
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error',$e->getMessage());
            }
        }

        $form->password = '';

        return $this->render('login', [
            'model' => $form,
        ]);

    }

    /**
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
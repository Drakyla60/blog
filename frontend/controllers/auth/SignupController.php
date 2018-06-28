<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 6/28/2018
 * Time: 3:46 PM
 */

namespace frontend\controllers\auth;


use core\forms\auth\SignupForm;
use core\useServices\auth\SignUpService;
use frontend\controllers\BasesController;
use Yii;
use yii\filters\AccessControl;

class SignupController extends BasesController
{
    /**
     * @var SignUpService
     */
    private $signUpService;

    /**
     * SignupController constructor.
     * @param $id
     * @param $module
     * @param SignUpService $signUpService
     * @param array $config
     */
    public function __construct($id, $module,
                                SignUpService $signUpService,
                                array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->signUpService = $signUpService;
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionRequest()
    {
        $form = new SignupForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try{
                $this->signUpService->signup($form);
                Yii::$app->session->setFlash('success',
                    'Check your email for further instruction.');
                return $this->goHome();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('signup', [
            'model' => $form,
        ]);
    }

    public function actionConfirm($token)
    {
        try {
            $this->signUpService->confirm($token);
            Yii::$app->session->setFlash('success', 'Your email is confirmed.');
            return $this->redirect(['/login']);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->goHome();
        }
    }
}
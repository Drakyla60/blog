<?php
namespace frontend\controllers;

use common\models\BlogTags;
use frontend\services\auth\PasswordResetService;
use frontend\services\auth\SignUpService;
use frontend\services\contact\ContactService;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\forms\LoginForm;
use frontend\forms\PasswordResetRequestForm;
use frontend\forms\ResetPasswordForm;
use frontend\forms\SignupForm;
use frontend\forms\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * @var PasswordResetService
     */
    private $passwordResetService;
    /**
     * @var ContactService
     */
    private $contactService;

    /**
     * SiteController constructor.
     * @param string $id
     * @param $module
     * @param PasswordResetService $passwordResetService
     * @param ContactService $contactService
     * @param array $config
     */
    public function __construct(string $id, $module,
                                PasswordResetService $passwordResetService,
                                ContactService $contactService,
                                array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->passwordResetService = $passwordResetService;
        $this->contactService = $contactService;
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $blogs = BlogTags::find()->all();
        return $this->render('index', [
            'blogs' => $blogs
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);

    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $form = new ContactForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {

            try {
                $this->contactService->send($form);
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
                return $this->goHome();
            }catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }
            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $form,
        ]);

    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionSignup()
    {
        $form = new SignupForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $user = (new SignUpService())->signup($form);
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
        }

        return $this->render('signup', [
            'model' => $form,
        ]);
    }


    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionRequestPasswordReset()
    {
        $form = new PasswordResetRequestForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try{
                (new PasswordResetService())->request($form);
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
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
    public function actionResetPassword($token)
    {
        $service = new PasswordResetService();

        try {
            $service->validateToken($token);
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        $form = new ResetPasswordForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $service->reset($token, $form);
                Yii::$app->session->setFlash('success', 'New password saved');
            }catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());

            }
            Yii::$app->session->setFlash('success', 'New password saved.');
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $form,
        ]);
    }
}

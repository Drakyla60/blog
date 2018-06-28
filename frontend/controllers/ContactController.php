<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 6/28/2018
 * Time: 3:49 PM
 */
namespace frontend\controllers;

use core\forms\ContactForm;
use core\useServices\contact\ContactService;
use Yii;

/**
 * Class ContactController
 * @package frontend\controllers
 */
class ContactController extends BasesController
{
    /**
     * @var ContactService
     */
    private $contactService;

    /**
     * ContactController constructor.
     * @param $id
     * @param $module
     * @param ContactService $contactService
     * @param array $config
     */
    public function __construct($id, $module,
                                ContactService $contactService,
                                array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->contactService = $contactService;
    }
    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $form = new ContactForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {

            try {
                $this->contactService->send($form);
                Yii::$app->session->setFlash('success',
                    'Thank you for contacting us. We will respond to you as soon as possible.');
                return $this->goHome();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error',
                    'There was an error sending your message.');
            }
            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $form,
        ]);

    }
}
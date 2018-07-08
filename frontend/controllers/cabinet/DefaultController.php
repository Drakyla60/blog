<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/8/2018
 * Time: 4:57 PM
 */

namespace frontend\controllers\cabinet;


use frontend\controllers\BasesController;
use yii\filters\AccessControl;

class DefaultController extends BasesController
{
    public function behaviors(): array
    {
        parent::behaviors();
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {

        return $this->render('index');
    }
}
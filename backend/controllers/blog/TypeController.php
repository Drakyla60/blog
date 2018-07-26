<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/26/2018
 * Time: 8:46 PM
 */
namespace backend\controllers\blog;


use backend\forms\Blog\TypeSearch;
use core\entities\Blog\Type;
use core\forms\manage\Blog\TypeForm;
use core\useServices\manage\Blog\TypeManageService;
use DomainException;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class TypeController
 * @package blog
 */
class TypeController extends Controller
{
    /**
     * @var TypeManageService
     */
    private $typeManageService;

    /**
     * TypeController constructor.
     * @param $id
     * @param $module
     * @param TypeManageService $typeManageService
     * @param array $config
     */
    public function __construct($id, $module, TypeManageService $typeManageService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->typeManageService = $typeManageService;
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                  'delete' => ['POST']
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
           'searchModel' => $searchModel,
           'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'type' => $this->findModel($id),
        ]);
    }


    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $form = new TypeForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $type = $this->typeManageService->create($form);
                return $this->redirect(['view', 'id' => $type->id]);
            }catch (DomainException $exception) {
                Yii::$app->errorHandler->logException($exception);
                Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        }
        return $this->render('create', [
           'model' => $form
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $type = $this->findModel($id);

        $form = new TypeForm($type);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->typeManageService->edit($type->id, $form);
                return $this->redirect(['view', 'id' => $type->id]);
            } catch (\DomainException $exception) {
                Yii::$app->errorHandler->logException($exception);
                Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'brand' => $type,
        ]);
    }


    /**
     * @param $id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        try {
            $this->typeManageService->remove($id);
        } catch (\DomainException $exception) {
            Yii::$app->errorHandler->logException($exception);
            Yii::$app->session->setFlash('error', $exception->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return Type
     * @throws NotFoundHttpException
     */
    protected function findModel($id): Type
    {
        if (($model = Type::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
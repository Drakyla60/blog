<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/27/2018
 * Time: 1:53 PM
 */

namespace backend\controllers\blog;


use backend\controllers\BasesController;
use backend\forms\Blog\CategorySearch;
use core\entities\Blog\Category;
use core\forms\manage\Blog\CategoryForm;
use core\useServices\manage\Blog\CategoryManageService;
use DomainException;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * Class CategoryController
 * @package blog
 */
class CategoryController extends BasesController
{
    /**
     * @var CategoryManageService
     */
    private $categoryManageService;

    /**
     * CategoryController constructor.
     * @param $id
     * @param $module
     * @param CategoryManageService $categoryManageService
     * @param array $config
     */
    public function __construct($id, $module, CategoryManageService $categoryManageService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->categoryManageService = $categoryManageService;
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
        $searchModel = new CategorySearch();
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
            'category' => $this->findModel($id),
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $form = new CategoryForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $type = $this->categoryManageService->create($form);
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
        $category = $this->findModel($id);

        $form = new CategoryForm($category);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->categoryManageService->edit($category->id, $form);
                return $this->redirect(['view', 'id' => $category->id]);
            } catch (DomainException $exception) {
                Yii::$app->errorHandler->logException($exception);
                Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'category' => $category,
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
            $this->categoryManageService->remove($id);
        } catch (DomainException $exception) {
            Yii::$app->errorHandler->logException($exception);
            Yii::$app->session->setFlash('error', $exception->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return Category
     * @throws NotFoundHttpException
     */
    protected function findModel($id): Category
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
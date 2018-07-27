<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/27/2018
 * Time: 12:54 PM
 */

namespace backend\controllers\blog;


use backend\controllers\BasesController;
use backend\forms\Blog\TagSearch;
use core\entities\Blog\Tag;
use core\forms\manage\Blog\TagForm;
use core\useServices\manage\Blog\TagManageService;
use DomainException;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * Class TagController
 * @package blog
 */
class TagController extends BasesController
{
    /**
     * @var TagManageService
     */
    private $tagManageService;

    /**
     * TagController constructor.
     * @param $id
     * @param $module
     * @param TagManageService $tagManageService
     * @param array $config
     */
    public function __construct($id, $module, TagManageService $tagManageService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->tagManageService = $tagManageService;
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
        $searchModel = new TagSearch();
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
            'tag' => $this->findModel($id),
        ]);
    }


    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $form = new TagForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $type = $this->tagManageService->create($form);
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
        $tag = $this->findModel($id);

        $form = new TagForm($tag);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->tagManageService->edit($tag->id, $form);
                return $this->redirect(['view', 'id' => $tag->id]);
            } catch (DomainException $exception) {
                Yii::$app->errorHandler->logException($exception);
                Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'brand' => $tag,
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
            $this->tagManageService->remove($id);
        } catch (DomainException $exception) {
            Yii::$app->errorHandler->logException($exception);
            Yii::$app->session->setFlash('error', $exception->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return Tag
     * @throws NotFoundHttpException
     */
    protected function findModel($id): Tag
    {
        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
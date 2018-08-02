<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 8/2/2018
 * Time: 12:57 PM
 */

namespace backend\controllers\blog;


use backend\controllers\BasesController;
use backend\forms\Blog\PostSearch;
use core\entities\Blog\Post\Post;
use core\forms\manage\Blog\Post\PhotosForm;
use core\forms\manage\Blog\Post\PostCreateForm;
use core\forms\manage\Blog\Post\PostEditForm;
use core\useServices\manage\Blog\PostManageService;
use DomainException;
use Throwable;
use Yii;
use yii\filters\VerbFilter;

/**
 * Class PostController
 * @package blog
 */
class PostController extends BasesController
{
    /**
     * @var PostManageService
     */
    private $postManageService;

    /**
     * PostController constructor.
     * @param $id
     * @param $module
     * @param PostManageService $postManageService
     * @param array $config
     */
    public function __construct($id, $module,
                                PostManageService $postManageService,
                                array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->postManageService = $postManageService;
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
                  'delete' => ['POST'],
                  'delete-photo' => ['POST'],
                  'move-photo-up' => ['POST'],
                  'move-photo-down' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionView($id)
    {
        $post = $this->findModel($id);

        $photosForm = new PhotosForm();
        if ($photosForm->load(Yii::$app->request->post()) && $photosForm->validate()) {
            try {
                $this->postManageService->addPhotos($post->id, $photosForm);
                return $this->redirect(['view', 'id' => $post->id]);
            } catch (DomainException $exception) {
                Yii::$app->errorHandler->logException($exception);
                Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        }

        return $this->render('view', [
            'post' => $post,
            'photosForm' => $photosForm,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     * @throws Throwable
     */
    public function actionCreate()
    {
        $form = new PostCreateForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $post = $this->postManageService->create($form);
                return $this->redirect(['view', 'id' => $post->id]);
            } catch (DomainException $exception) {
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
     * @return \yii\web\Response
     * @throws Throwable
     */
    public function actionUpdate($id)
    {
        $post = $this->findModel($id);

        $form = new PostEditForm($post);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->postManageService->edit($post->id, $form);
                return $this->redirect(['view', 'id' => $post->id]);
            } catch (DomainException $exception) {
                Yii::$app->errorHandler->logException($exception);
                Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        }
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        try {
            $this->postManageService->remove($id);
        }catch (DomainException $exception) {
            Yii::$app->session->setFlash('error', $exception->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @param $photo_id
     * @return \yii\web\Response
     */
    public function actionDeletePhoto($id, $photo_id)
    {
        try {
            $this->postManageService->removePhoto($id, $photo_id);
        }
        catch (DomainException $exception) {
            Yii::$app->session->setFlash('error', $exception->getMessage());
        }
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }

    /**
     * @param $id
     * @param $photo_id
     * @return \yii\web\Response
     */
    public function actionMovePhotoUp($id, $photo_id)
    {
        $this->postManageService->movePhotoUp($id, $photo_id);
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }

    /**
     * @param $id
     * @param $photo_id
     * @return \yii\web\Response
     */
    public function actionMovePhotoDown($id, $photo_id)
    {
        $this->postManageService->movePhotoDown($id, $photo_id);
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }

    /**
     * @param $id
     * @return Post
     */
    protected function findModel($id): Post
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }
    }
}
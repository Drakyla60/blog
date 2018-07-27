<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/27/2018
 * Time: 12:36 PM
 */

/* @var $this yii\web\View */
/* @var $tag core\entities\Blog\Tag */
/* @var $model core\forms\manage\Blog\TagForm */

$this->title = 'Update Tag: ' . $tag->name;
$this->params['breadcrumbs'][] = ['label' => 'Tag', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $tag->name, 'url' => ['view', 'id' => $tag->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="brand-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
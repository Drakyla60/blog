<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/27/2018
 * Time: 3:19 PM
 */


/* @var $this yii\web\View */
/* @var $model core\forms\manage\Blog\CategoryForm*/

$this->title = 'Create Category';
$this->params['breadcrumbs'][] = ['label' => 'Category', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
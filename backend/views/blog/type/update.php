<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/26/2018
 * Time: 11:09 PM
 */

/* @var $this yii\web\View */
/* @var $type core\entities\Blog\Type */
/* @var $model core\forms\manage\Blog\TypeForm */

$this->title = 'Update Type: ' . $type->name;
$this->params['breadcrumbs'][] = ['label' => 'Type', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $type->name, 'url' => ['view', 'id' => $type->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="brand-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/26/2018
 * Time: 10:57 PM
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $type core\entities\Blog\Type */

$this->title = $type->name;
$this->params['breadcrumbs'][] = ['label' => 'Type', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $type->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $type->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Common</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $type,
                'attributes' => [
                    'id',
                    'name',
                    'slug',
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $type,
                'attributes' => [
                    'meta.title',
                    'meta.description',
                    'meta.keywords',
                ],
            ]) ?>
        </div>
    </div>
</div>
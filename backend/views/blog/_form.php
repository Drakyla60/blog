<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BlogPost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-post-form">

    <?php $form = ActiveForm::begin(); ?>
        <div class="col-md-9">
             <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Основні дані</div>
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
                    <?echo $form->field($model, 'description')->widget(CKEditor::class,[
                        'editorOptions' => ['preset' => 'basic', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                            'inline' => false, //по умолчанию false
                        ],
                    ]);?>
                    <?echo $form->field($model, 'content')->widget(CKEditor::class,[
                        'editorOptions' => ['preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                            'inline' => false, //по умолчанию false
                        ],
                    ]);?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Функції</div>
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'category_id')->textInput() ?>

                    <?= $form->field($model, 'status')->dropDownList(['0' => 'off', '1' => 'on']) ?>

                    <?= $form->field($model, 'comment_count')->textInput() ?>

                    <?= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>
                 </div>
            </div>
        </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">Мета теги для поста</div>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'meta_json')->textInput() ?>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

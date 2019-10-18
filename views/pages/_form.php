<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use sadovojav\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model backend\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <div class="box">
        <div class="box-body">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#uz" aria-controls="uz" role="tab" data-toggle="tab">O'zbekcha</a></li>
                <li role="presentation" class=""><a href="#ru" aria-controls="ru" role="tab" data-toggle="tab">Русский</a></li>
                <li role="presentation" class=""><a href="#en" aria-controls="en" role="tab" data-toggle="tab">English</a></li>
            </ul>
            <div class="tab-content">
                <br>
                <div role="tabpanel" class="tab-pane active" id="uz">
                    <?= $form->field($model, 'title_uz')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'content_uz')->widget(CKEditor::class, [
                        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
//                            'allowedContent' => true,
                            'extraPlugins' => 'image2,widget,oembed,video',
                            'language' => Yii::$app->language,
                            'height' => 300,
                        ]),
                    ]); ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="ru">
                    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'content_ru')->widget(CKEditor::class, [
                        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                            'allowedContent' => true,
                            'extraPlugins' => 'image2,widget,oembed,video',
                            'language' => Yii::$app->language,
                            'height' => 300,
                        ]),
                    ]); ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="en">
                    <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'content_en')->widget(CKEditor::class, [
                        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                            'allowedContent' => true,
                            'extraPlugins' => 'image2,widget,oembed,video',
                            'language' => Yii::$app->language,
                            'height' => 300,
                        ]),
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

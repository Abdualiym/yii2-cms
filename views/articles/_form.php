<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use sadovojav\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\Articles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>

    <div class="row">
        <div class="col-sm-8">
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
                            <?= $form->field($model, 'content_uz')->widget(CKEditor::class); ?>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="ru">
                            <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'content_ru')->widget(CKEditor::class); ?>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="en">
                            <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'content_en')->widget(CKEditor::class); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="box">
                <div class="box-body">
                    <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(\backend\models\ArticleCategories::find()->all(), 'id', 'title'), ['prompt' => '---']) ?>
                    <?php
                    echo $form->field($model, 'photo')->widget(\kartik\file\FileInput::class, [
                        'options' => ['accept' => 'image/*'],
                        'language' => 'ru',
                        'pluginOptions' => [
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            // 'browseIcon' => ' ',
                            'browseLabel' => 'Рисунок',
                            'layoutTemplates' => [
                                'main1' => '<div class="kv-upload-progress hide"></div>{remove}{cancel}{upload}{browse}{preview}',
                            ],
                            'initialPreview' => [
                                Html::img($model->getThumbFileUrl('photo', 'sm'), ['class' => 'file-preview-image', 'alt' => '', 'title' => '']),
                            ],
                        ],
                    ]);
                    ?>
                    <?php
                    $model->date = $model->date ?: time();
                    echo $form->field($model, 'date')->widget(\yii\jui\DatePicker::class, ['dateFormat' => 'd.MM.yyyy', 'clientOptions' => ['changeYear' => true], 'options' => ['class' => 'form-control']]);
                    ?>
                    <hr>
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success pull-right']) ?>
                </div>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>

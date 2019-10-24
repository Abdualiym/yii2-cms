<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use abdualiym\cms\assets\ScriptsAsset;
<<<<<<< HEAD
use abdualiym\cms\entities\Menu;
=======
use abdualiym\cms\models\Menu;
>>>>>>> 8b48ef3ca164c7e9625a53ec14596f9d17e4ff8e
use yii\helpers\ArrayHelper;


ScriptsAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<style type="text/css">
    .field-menu-action, .field-menu-alias, .field-menu-link, .field-menu-page_id {
        display: none;
    }
</style>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div style="margin:5px 0 0 0;" class="alert alert-success"><?= Yii::$app->session->getFlash('success') ?></div><?php endif; ?>
<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'title_uz')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'parent_id')->dropDownList([0 => Yii::t('app', 'No parent')] + ArrayHelper::map(Menu::find()->all(), 'id', 'title')) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'sort')->dropDownList([1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'type')->dropDownList($model->typesList(), ['prompt' => Yii::t('app', 'Choose')]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'action')->dropDownList(Menu::actionslist(), ['prompt' => Yii::t('app', 'Choose') . ' ' . $model->getAttributeLabel('action')]) ?>
            <?= $form->field($model, 'alias')->textInput(['placeholder' => $model->getAttributeLabel('alias')]) ?>
            <?= $form->field($model, 'link')->textInput(['placeholder' => 'http://']) ?>
            <?= $form->field($model, 'page_id')->dropDownList(ArrayHelper::map(\backend\models\Pages::find()->all(), 'id', 'title'), ['prompt' => Yii::t('app', 'Choose')]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
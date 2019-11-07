<?php

use abdualiym\cms\entities\Menu;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;



/* @var $this yii\web\View */
/* @var $model Menu */
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
            <ul class="nav nav-tabs" role="tablist">
                <?php foreach (Yii::$app->controller->module->languages as $key => $language) : ?>
                    <li role="presentation" <?= $key == 0 ? 'class="active"' : '' ?>>
                        <a href="#<?= $key ?>" aria-controls="<?= $key ?>" role="tab" data-toggle="tab"><?= $language ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content">
                <br>
                <?php foreach (Yii::$app->controller->module->languages as $key => $language) : ?>
                    <div role="tabpanel" class="tab-pane <?= $key == 0 ? 'active' : '' ?>" id="<?= $key ?>">
                        <?php //= $model->showData($key); ?>

                        <?= $form->field($model, 'title_' . $key)->textInput(['maxlength' => true]) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'parent_id')->dropDownList([0 => Yii::t('cms', 'No parent')] + ArrayHelper::map(Menu::find()->all(), 'id', 'title')) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'sort')->dropDownList([1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'type')->dropDownList($model->typesList(), ['prompt' => Yii::t('cms', 'Choose')]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'type_helper')->dropDownList(Menu::actionsList(), ['prompt' => Yii::t('cms', 'Choose') . ' ' . Yii::t('cms', 'action')]) ?>
            <?= $form->field($model, 'alias')->textInput(['placeholder' => $model->getAttributeLabel('alias')]) ?>
            <?= $form->field($model, 'link')->textInput(['placeholder' => 'http://']) ?>
            <?= $form->field($model, 'page_id')->dropDownList(ArrayHelper::map(\backend\models\Pages::find()->all(), 'id', 'title'), ['prompt' => Yii::t('cms', 'Choose')]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('cms', 'Create') : Yii::t('cms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>

<script>
    $(document).ready(function () {
        var type = $('#menu-type').val();
        typeControl(type);

        $('#menu-type').on('change', function () {
            typeControl(this.value);
        });

        function typeControl(type) {
            var t = 333;
            var ac = $('.field-menu-action');
            var al = $('.field-menu-alias');
            var ln = $('.field-menu-link');
            var tr = $('.field-menu-page_id');
            if (!type || type == 5) {
                ac.hide();
                al.hide();
                tr.hide();
                ln.hide();
            } else if (type == <?= Menu::TYPE_ACTION ?>) {
                ac.slideDown(t);
                al.hide();
                tr.hide();
                ln.hide();
            } else if (type == 2) {
                ac.hide();
                al.slideDown(t);
                tr.hide();
                ln.hide();
            } else if (type == 3) {
                ac.hide();
                al.hide();
                tr.hide();
                ln.hide();
            } else if (type == 4) {
                ac.hide();
                al.hide();
                tr.hide();
                ln.slideDown(t);
            } else if (type == 11) {
                ac.hide();
                al.hide();
                tr.slideDown();
                ln.hide(t);
            } else if (type == 6 || type == 7 || type == 8 || type == 9) {
                ac.hide();
                al.slideDown(t);
                tr.hide();
                ln.hide();
            }
        }
    }); //Конец ready
</script>
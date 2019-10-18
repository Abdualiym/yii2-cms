<?php

/* @var $this yii\web\View */
/* @var $model \abdualiym\cms\entities\Block */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => Yii::t('block', 'Blocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-add">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

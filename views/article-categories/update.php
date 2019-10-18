<?php

/* @var $this yii\web\View */
/* @var $model backend\models\ArticleCategories */

$this->title = Yii::t('app', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Article Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="article-categories-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

/* @var $this yii\web\View */
/* @var $model backend\models\ArticleCategories */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-categories-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

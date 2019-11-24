<?php

use yii\helpers\Html;
use yii\grid\GridView;
use abdualiym\cms\forms\MenuSearch;

/* @var $this yii\web\View */
/* @var $searchModel MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cms', 'Menu');
$this->params['breadcrumbs'][] = $this->title;

echo \abdualiym\cms\widgets\menu\MenuWidget::widget();

?>
<div class="menu-index">

    <p>
        <?= Html::a(Yii::t('cms', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'parent.title_0',
            'title_0',
            'sort',
            'type',
            'created_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

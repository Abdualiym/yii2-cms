<?php

use backend\models\Menu;
use yii\helpers\Html;

?>
<!--        <div class="menu fixed">-->
<div class="menu">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainMenu">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="mainMenu">
                    <ul class="nav navbar-nav">
                        <!--                        <li class="dropdown"><a class="dropdown-toggle" href="http://www.dtm.uz/#" data-toggle="dropdown">Markaz haqida</a>-->
                        <!--                            <ul class="dropdown-menu">-->
                        <!--                                <li><a href="http://www.dtm.uz/page/history">Markaz tarixi</a></li>-->
                        <!--                                <li><a href="http://www.dtm.uz/page/management">Rahbariyat</a></li>-->
                        <!--                            </ul>-->
                        <!--                        </li>-->
                        <!--                        <li><a href="http://www.dtm.uz/page/contact">Bog‘lanish</a></li>-->
                        <?php
                        foreach ($menu as $key => $value) {
                            if ($value['type'] != Menu::TYPE_EMPTY) {
                                echo '<li><a href="' . $value['link'] . '">' . $value['title_' . Yii::$app->language] . '</a></li>';
                            } else {
                                echo '<li class="dropdown">'
                                    . '<a href="#' . $value['link'] . '" class="dropdown-toggle" data-toggle="dropdown">' . $value['title_' . Yii::$app->language] . '</a>';
                                if (isset($value['childs']) && $value['childs']) {
                                    echo '<ul class="dropdown-menu">';
                                    foreach ($value['childs'] as $key => $v) {
                                        echo '<li><a href="' . $v['link'] . '">' . $v['title_' . Yii::$app->language] . '</a></li>';
                                    }
                                    echo '</ul>';
                                }
                                echo '</li>';
                            }
                        }
                        ?>
                        <?php if (Yii::$app->user->isGuest): ?>
                            <li><a href="/auth/login">Registratura</a></li>
                        <?php else: ?>
                            <li><a href="/profile"><?= Yii::t('app', 'Profil') ?></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

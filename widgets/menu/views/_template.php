<?php

use abdualiym\cms\entities\Menu;
use abdualiym\cms\helpers\Language;

$url = Yii::$app->language;

foreach ($menu as $key => $value) {
    if ($value['type'] != Menu::TYPE_EMPTY) {
        echo '<li><a href="' . $value['link'] . '">' . Language::getAttribute($value, 'title', $url) . '</a></li>';
    } else {
        if (isset($value['childs']) && $value['childs']) {
            echo '<li class="dropdown">' . '<a href="' . $value['link'] . '" class="dropdown-toggle" data-toggle="dropdown">' . Language::getAttribute($value, 'title', $url) . ' <b class="caret"></b></a>';
            echo '<ul class="dropdown-menu">';
            foreach ($value['childs'] as $key => $childValue) {
                if (isset($childValue['childs']) && $childValue['childs']) {
                    echo '<li class="dropdown">' . '<a href="' . $childValue['link'] . '" class="dropdown-toggle" data-toggle="dropdown">' . Language::getAttribute($childValue, 'title', $url) . ' <b class="caret"></b></a>';
                    echo '<ul class="dropdown-menu">';
                    foreach ($childValue['childs'] as $key => $children) {
                        echo '<li><a href="' . $children['link'] . '">' . Language::getAttribute($children, 'title', $url) . '</a></li>';
                    }
                    echo '</ul>';
                    echo '</li>';
                } else {
                    echo '<li><a href="' . $childValue['link'] . '">' . Language::getAttribute($childValue, 'title', $url) . '</a></li>';
                }
            }
            echo '</ul>';
            echo '</li>';
        } else {
            echo '<li><a href="' . $value['link'] . '">' . Language::getAttribute($value, 'title', $url) . '</a></li>';
        }
    }
}

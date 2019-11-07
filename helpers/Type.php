<?php

namespace abdualiym\cms\helpers;

use yiidreamteam\upload\ImageUploadBehavior;
use Yii;

class Type
{
    public static function imageConfig()
    {
        $module = Yii::$app->getModule('cms');

        return [
            'class' => ImageUploadBehavior::class,
            'attribute' => 'photo',
            'createThumbsOnRequest' => true,
            'filePath' => $module->storageRoot . '/yii2-cms/data/[[attribute_id]]/[[photo]].[[extension]]',
            'fileUrl' => $module->storageHost . '/yii2-cms/data/[[attribute_id]]/[[photo]].[[extension]]',
            'thumbPath' => $module->storageRoot . '/yii2-cms/cache/[[attribute_id]]/[[profile]]_[[photo]].[[extension]]',
            'thumbUrl' => $module->storageHost . '/yii2-cms/cache/[[attribute_id]]/[[profile]]_[[photo]].[[extension]]',
            'thumbs' => $module->thumbs
        ];
    }
}
<?php

namespace abdualiym\cms\helpers;


class Language
{
    public static function getAttribute($className, string $attributeName, $key)
    {
        if(is_string($key)){
            $key = \Yii::$app->params['cms']['languageIds'][$key];
        }
        return $className[$attributeName . '_' . $key];
    }

    public static function get($className, string $attributeName, string $key)
    {
        return $className[$attributeName . '_' . $key];
    }

    public static function dataKeys()
    {
        return [0, 1, 2, 3];
    }
}

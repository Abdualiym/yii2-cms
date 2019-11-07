<?php

namespace abdualiym\cms\helpers;


class LanguageHelper
{
    public static function getAttribute($className, string $attributeName, $key)
    {
        $attribute = $attributeName . '_' . $key;
        return $className->$attribute;
    }
}
<?php

namespace abdualiym\cms\entities;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $title_0
 * @property string $title_1
 * @property string $title_2
 * @property string $title_3
 * @property int $type
 * @property string $type_helper
 * @property int $sort
 * @property int $created_at
 * @property int $updated_at
 */
class Menu extends \yii\db\ActiveRecord
{
    const TYPE_ACTION = 1;
    const TYPE_LINK = 2;
    const TYPE_EMPTY = 3;
    const TYPE_PAGE = 4;
    const TYPE_FEED = 5;
//    const TYPE_ACTION = 1; // action
////    const TYPE_PAGE = 2; // page content
//    const TYPE_CROSSING = 3; // page crossing
//    const TYPE_LINK = 4; // link
//    const TYPE_EMPTY = 5; // empty == #
//    const TYPE_FEED_LIST = 6; // feed shows as lists
//    const TYPE_FEED_POST = 7; // feed shows as articles
//    const TYPE_FEED_IMAGE = 8; // feed shows as gallery
//    const TYPE_FEED_INFO = 9; // feed shows from needs
//    const TYPE_PAGE = 11; // feed shows from needs



    public static function tableName()
    {
        return 'abdualiym_cms_menu';
    }

    public function rules()
    {
        return [
            ['title_0', 'required', 'when' => function () {
                return in_array(0, $this->CMSModule->languages);
            }],
            ['title_1', 'required', 'when' => function () {
                return in_array(1, $this->CMSModule->languages);
            }],
            ['title_2', 'required', 'when' => function () {
                return in_array(2, $this->CMSModule->languages);
            }],
            ['title_3', 'required', 'when' => function () {
                return in_array(3, $this->CMSModule->languages);
            }],
            [['title_0', 'title_1', 'title_2', 'title_3'], 'string', 'max' => 255],

            [['type'], 'required'],
            ['type', 'integer'],
            [['type_helper'], 'string', 'max' => 255],

            [['parent_id', 'sort'], 'integer'],
            ['parent_id', 'exist', 'targetClass' => self::class, 'targetAttribute' => 'id'],














            ['action', 'required', 'when' => function ($model) {
                return $model->type == self::TYPE_ACTION;
            }, 'enableClientValidation' => false],
            ['action', 'in', 'range' => self::actionsList(true), 'allowArray' => true, 'when' => function ($model) {
                return $model->type == self::TYPE_ACTION;
            }, 'enableClientValidation' => false],

            ['page_id', 'required', 'when' => function ($model) {
                return $model->type == self::TYPE_PAGE;
            }, 'enableClientValidation' => false],
            ['page_id', 'exist', 'targetClass' => Pages::class, 'targetAttribute' => 'id', 'when' => function ($model) {
                return $model->type == self::TYPE_PAGE;
            }, 'enableClientValidation' => false],
            ['alias', 'unique', 'when' => function ($model) {
                return $model->type == self::TYPE_PAGE;
            }, 'enableClientValidation' => false],

            ['link', 'required', 'when' => function ($model) {
                return $model->type == self::TYPE_LINK;
            }, 'enableClientValidation' => false],
            ['link', 'string', 'when' => function ($model) {
                return $model->type == self::TYPE_LINK;
            }, 'enableClientValidation' => false],
        ];
    }

    public function actionsList($flip = false)
    {
        $array = [
            '/' => '"Главная страница"',
            'blog' => '"Новости"',
            'site/contacts' => '"Контакты"',
        ];
        if (is_string($flip) && array_key_exists($flip, $array))
            return $array[$flip];
        elseif ($flip)
            return array_flip($array);
        return $array;
    }

    public function typesList($key = null)
    {
        $a = [];

        if (defined('self::TYPE_ACTION')) {
            $a[self::TYPE_ACTION] = 'Предопределенный модул';
        }
        if (defined('self::TYPE_PAGE')) {
            $a[self::TYPE_PAGE] = 'Страница сайта';
        }
        if (defined('self::TYPE_LINK')) {
            $a[self::TYPE_LINK] = 'Ссылка';
        }
        if (defined('self::TYPE_EMPTY')) {
            $a[self::TYPE_EMPTY] = 'Родитель для вложения подменю';
        }
//        if (defined('self::TYPE_TOURNAMENT')) {
//            $a['types'][self::TYPE_TOURNAMENT] = 'Турнир';
//        }

        if ($key && isset($a[$key])) {
            return $a[$key];
        } else {
            return $a;
        }
    }

    public function getParents()
    {
        return $this->hasOne(self::class, ['id' => 'parent_id'])->from('menu' . ' m');
    }

    public function getPage()
    {
        return $this->hasOne(Pages::class, ['id' => 'page_id']);
    }

    public function getParent()
    {
        return $this->hasOne(self::class, ['id' => 'parent_id']);
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cms', 'ID'),
            'parent_id' => Yii::t('cms', 'Parent ID'),
            'title' => Yii::t('cms', 'Title'),
            'type' => Yii::t('cms', 'Type'),
            'type_helper' => Yii::t('cms', 'Type Helper'),
            'sort' => Yii::t('cms', 'Sort'),/
            'created_at' => Yii::t('cms', 'Created At'),
            'updated_at' => Yii::t('cms', 'Updated At'),
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

}

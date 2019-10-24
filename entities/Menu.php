<?php

namespace abdualiym\cms\entities;

use common\helpers\LanguageHelper;
use Yii;
use abdualiym\cms\entities\user\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $title
 * @property int $type
 * @property string $type_helper
 * @property int $sort
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Menu extends \yii\db\ActiveRecord
{
    const STATUS_PAGE_NOT_PUBLIC = 0;
    const STATUS_PAGE_PUBLIC = 1;
    const STATUS_NOT_IN_TOP_MENU = 0;
    const STATUS_IN_TOP_MENU = 1;
    const TYPE_ACTION = 1; // action
//    const TYPE_PAGE = 2; // page content
    const TYPE_CROSSING = 3; // page crossing
    const TYPE_LINK = 4; // link
    const TYPE_EMPTY = 5; // empty == #
    const TYPE_FEED_LIST = 6; // feed shows as lists
    const TYPE_FEED_POST = 7; // feed shows as articles
    const TYPE_FEED_IMAGE = 8; // feed shows as gallery
    const TYPE_FEED_INFO = 9; // feed shows from needs
    const TYPE_PAGE = 11; // feed shows from needs


    public function rules()
    {
        return [
            [['title_uz', 'title_ru', 'title_en', 'type'], 'required'],
            [['parent_id', 'type', 'sort'], 'integer'],
            [['title_uz', 'title_ru', 'title_en', 'type_helper'], 'string', 'max' => 255],

            ['parent_id', 'exist', 'targetAttribute' => 'id', 'when' => function ($model) {
                return $model->parent_id > 0;
            }],
            // if page is action, type_helper is action name
            ['action', 'required', 'when' => function ($model) {
                return $model->type == self::TYPE_ACTION;
            }, 'enableClientValidation' => false],
            ['page_id', 'required', 'when' => function ($model) {
                return $model->type == self::TYPE_PAGE;
            }, 'enableClientValidation' => false],
            ['page_id', 'exist', 'targetClass' => Pages::class, 'targetAttribute' => 'id', 'when' => function ($model) {
                return $model->type == self::TYPE_PAGE;
            }, 'enableClientValidation' => false],
            ['action', 'in', 'range' => self::actionsList(true), 'allowArray' => true, 'when' => function ($model) {
                return $model->type == self::TYPE_ACTION;
            }, 'enableClientValidation' => false],
            // if page must have content, type_helper is "alias"
//            [['alias'], 'required', 'when' => function($model) {
//                    return $model->type == self::TYPE_PAGE;
//                }, 'enableClientValidation' => false],
            ['alias', 'unique', 'when' => function ($model) {
                return $model->type == self::TYPE_PAGE;
            }, 'enableClientValidation' => false],
            // if page is url link
            ['link', 'required', 'when' => function ($model) {
                return $model->type == self::TYPE_LINK;
            }, 'enableClientValidation' => false],
            ['link', 'string', 'when' => function ($model) {
                return $model->type == self::TYPE_LINK;
            }, 'enableClientValidation' => false],
            // if page is empty(#) link for parenting
            // noting to do
            // if page is feed parent
            ['alias', 'required', 'when' => function ($model) {
                return in_array($model->type, self::typesList('feeds'));
            }, 'enableClientValidation' => false],
            ['alias', 'unique', 'when' => function ($model) {
                return in_array($model->type, self::typesList('feeds'));
            }, 'enableClientValidation' => false],
        ];
    }


    public function typesList($param = null)
    {
        $a = [
            'types' => [],
            'feeds' => []
        ];

        // types array
        if (defined('self::TYPE_ACTION')) {
            $a['types'][self::TYPE_ACTION] = 'Предопределенный модул';
        }
        if (defined('self::TYPE_PAGE')) {
            $a['types'][self::TYPE_PAGE] = 'Страница сайта';
        }
//         if (defined('self::TYPE_CROSSING'))   { $a['types'][self::TYPE_CROSSING]   = 'Переход на другую страницу'; }
        if (defined('self::TYPE_LINK')) {
            $a['types'][self::TYPE_LINK] = 'Ссылка';
        }
        if (defined('self::TYPE_EMPTY')) {
            $a['types'][self::TYPE_EMPTY] = 'Родитель для вложения подменю';
        }
//        if (defined('self::TYPE_TOURNAMENT')) {
//            $a['types'][self::TYPE_TOURNAMENT] = 'Турнир';
//        }
        // feeds array
//        if (defined('self::TYPE_FEED_LIST')) {$a['feeds'][self::TYPE_FEED_LIST] = 'Родительский тип - "Лист"';}
//        if (defined('self::TYPE_FEED_POST')) {
//            $a['feeds'][self::TYPE_FEED_POST] = 'Родительский тип - "Статьи"';
//        }
//        if (defined('self::TYPE_FEED_IMAGE')) {
//            $a['feeds'][self::TYPE_FEED_IMAGE] = 'Родительский тип - "Галерея"';
//        }
//         if (defined('self::TYPE_FEED_INFO')) { $a['feeds'][self::TYPE_FEED_INFO] = 'Родительский тип - "Инфо"'; }

        if (is_numeric($param)) {
            $a = $a['types'] + $a['feeds'];
            return $a[$param];
        } else {
            return ($param == 'types' || $param == 'feeds') ? $a[$param] : ($a['types'] + $a['feeds']);
        }
    }

    public function actionsList($flip = false)
    {
        $array = [
            '/' => '"Главная страница"',
//            'site/analitics?type=clubs' => '"Анализ команд"',
//            'site/clubs-analitic' => '"Анализ команд"',
//            'site/analitics?type=clubs' => '"Анализ команд"',
//            'site/analitics?type=players' => '"Анализ футболистов"',
//            'site/archived' => '"Архивные"',
//            'site/transfers' => '"Трансферы"',
            'blog' => '"Новости"',
//            'site/players' => '"Футболисты"',
            'library' => '"Литература"',
            'site/contacts' => '"Контакты"',
            'personal' => '"База тренеров"',
            'courses' => '"Курсы"',
        ];
        if (is_string($flip) && array_key_exists($flip, $array))
            return $array[$flip];
        elseif ($flip)
            return array_flip($array);
        return $array;
    }


    public function typeFilter($model)
    {
        if ($model->type == self::TYPE_ACTION) {
            $model->alias = '';
            $model->link = '';
        } elseif ($model->type == self::TYPE_LINK) {
            $model->action = '';
            $model->alias = '';
//        } elseif ($model->type == self::TYPE_EMPTY) {
//            $model->action = '';
//            $model->alias = '';
//            $model->link = '';
        } elseif ($model->type == self::TYPE_PAGE) {
            $model->action = '';
            $model->alias = '';
            $model->link = '';
        } else {
            $model->action = '';
            $model->link = '';
        }
        return $model;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
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

    public function getTitle()
    {
        return LanguageHelper::getAttribute($this, 'title');
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
//            'parent' => Yii::t('app', 'Parent'),
            'title' => Yii::t('app', 'Title'),

            'type' => Yii::t('app', 'Type'),
            'type_helper' => Yii::t('app', 'Type Helper'),

            'action' => Yii::t('app', 'Модул'),
            'alias' => Yii::t('app', 'Алиас'),
            'link' => Yii::t('app', 'Ссылка'),

            'sort' => Yii::t('app', 'Sort'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    public static function tableName()
    {
        return 'menu';
    }


    public function behaviors()
    {
        return [
            BlameableBehavior::class,
            TimestampBehavior::class,
        ];
    }

}

<?php

namespace backend\models;

use backend\entities\user\User;
use common\helpers\LanguageHelper;
use common\helpers\StringHelper;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title_uz
 * @property string $title_ru
 * @property string $title_en
 * @property string $alias
 * @property string $content_uz
 * @property string $content_ru
 * @property string $content_en
 * @property string $photo
 * @property int $date
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_uz', 'title_ru', 'title_en'], 'required'],
            [['title_uz', 'title_ru', 'title_en'], 'string', 'max' => 255],

            [['content_uz', 'content_ru', 'content_en'], 'string'],

            [['category_id'], 'required'],
            [['category_id'], 'integer'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ArticleCategories::class, 'targetAttribute' => ['category_id' => 'id']],

            [['status'], 'boolean'],
            [['status'], 'default', 'value' => true],

            [['date'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title_uz' => Yii::t('app', 'Title'),
            'title_ru' => Yii::t('app', 'Title'),
            'title_en' => Yii::t('app', 'Title'),
            'alias' => Yii::t('app', 'Alias'),
            'category_id' => Yii::t('app', 'Categories'),
            'content_uz' => Yii::t('app', 'Content'),
            'content_ru' => Yii::t('app', 'Content'),
            'content_en' => Yii::t('app', 'Content'),
            'date' => Yii::t('app', 'Date'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }


    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }


    public function getCategory()
    {
        return $this->hasOne(ArticleCategories::class, ['id' => 'category_id']);
    }


    public function cutContent($length = 100)
    {
        return StringHelper::slice($this->content, $length);
    }


    public function getContent()
    {
        return LanguageHelper::getAttribute($this, 'content');
    }


    public function getTitle()
    {
        return LanguageHelper::getAttribute($this, 'title');
    }


    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
            [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date'],
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date'],
                ],
                'value' => function ($event) {
                    return (int)strtotime($this->date);
                },
            ],
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
                'slugAttribute' => 'alias',
                'attribute' => 'title_ru',
                // optional params
                'ensureUnique' => true,
                'replacement' => '-',
                'lowercase' => true,
                // false = changes after every change for $attribute
                'immutable' => false,
                // If intl extension is enabled, see http://userguide.icu-project.org/transforms/general.
                'transliterateOptions' => 'Russian-Latin/BGN; Any-Latin; Latin-ASCII; NFD; [:Nonspacing Mark:] Remove; NFC;'
            ],
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'photo',
                'createThumbsOnRequest' => true,
                'filePath' => '@storageRoot/articles/[[attribute_id]]/[[filename]].[[extension]]',
                'fileUrl' => '@storageHostInfo/articles/[[attribute_id]]/[[filename]].[[extension]]',
                'thumbPath' => '@storageRoot/cache/articles/[[attribute_id]]/[[profile]]_[[filename]].[[extension]]',
                'thumbUrl' => '@storageHostInfo/cache/articles/[[attribute_id]]/[[profile]]_[[filename]].[[extension]]',
                'thumbs' => [
                    'xs' => ['width' => 53, 'height' => 30],
                    'sm' => ['width' => 106, 'height' => 60],
                    'md' => ['width' => 212, 'height' => 120],
                    'index' => ['width' => 313, 'height' => 180],
                    'lg' => ['width' => 848, 'height' => 480],
                ],
            ],
        ];
    }

}

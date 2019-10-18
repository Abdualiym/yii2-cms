<?php

namespace backend\models;

use backend\entities\user\User;
use common\helpers\LanguageHelper;
use common\helpers\StringHelper;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string $title_uz
 * @property string $title_ru
 * @property string $title_en
 * @property string $alias
 * @property string $content_uz
 * @property string $content_ru
 * @property string $content_en
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_uz', 'title_ru', 'title_en', 'alias'], 'required'],
            [['content_uz', 'content_ru', 'content_en'], 'string'],
            [['title_uz', 'title_ru', 'title_en', 'alias'], 'string', 'max' => 255],
            [['alias'], 'unique'],
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
            'content_uz' => Yii::t('app', 'Content'),
            'content_ru' => Yii::t('app', 'Content'),
            'content_en' => Yii::t('app', 'Content'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
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

    public function getContent()
    {
        return LanguageHelper::getAttribute($this, 'content');
    }


    public function cutContent($length)
    {
        return StringHelper::slice($this->content, $length);
    }


    public function getTitle()
    {
        return LanguageHelper::getAttribute($this, 'title');
    }


    public function behaviors()
    {
        return [
            BlameableBehavior::class,
            TimestampBehavior::class,
        ];
    }

}

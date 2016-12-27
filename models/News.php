<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nws_news".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $description
 * @property string $article
 * @property string $create_date
 *
 * @property NwsComment[] $nwsComments
 * @property User $user
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * Validate constants
     */
    const DESCRIPTION_MAX_LENGTH = 255;
    const ARTICLE_MAX_LENGTH = 65000;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nws_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'description', 'article'], 'required'],
            [['user_id'], 'integer'],
            [['article'], 'string', 'max' => self::ARTICLE_MAX_LENGTH],
            [['create_date'], 'safe'],
            [['description'], 'string', 'max' => self::DESCRIPTION_MAX_LENGTH],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'description' => 'Описание',
            'article' => 'Статья',
            'create_date' => 'Create Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNwsComments()
    {
        return $this->hasMany(NwsComment::className(), ['news_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsQuery(get_called_class());
    }
}

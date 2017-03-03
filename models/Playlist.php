<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\models;

use app\models\common\ActiveRecordTrait;
use app\models\query\PlaylistQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property int $id
 * @property string $title
 * @property int $status
 * @property int $frequency
 * @property int $created_at
 * @property int $updated_at
 * @property PlaylistItem[] $items
 */
class Playlist extends ActiveRecord
{
    use ActiveRecordTrait;

    const STATUS_INCOMPLETE = 0;
    const STATUS_PUBLISH = 1;
    const STATUS_PRIVATE = 2;

    const STATUS_INCOMPLETE_TEXT = 'Incomplete';
    const STATUS_PUBLISH_TEXT = 'Publish';
    const STATUS_PRIVATE_TEXT = 'Private';

    const STATUS_DATA = [
        self::STATUS_INCOMPLETE => self::STATUS_INCOMPLETE_TEXT,
        self::STATUS_PUBLISH => self::STATUS_PUBLISH_TEXT,
        self::STATUS_PRIVATE => self::STATUS_PRIVATE_TEXT,
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'playlist';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'frequency' => 'tracks',
        ];
    }

    /**
     * {@inheritdoc}
     * @return PlaylistQuery
     */
    public static function find()
    {
        return new PlaylistQuery(static::class);
    }

    /**
     * Returns all playlist list.
     * @return string[]
     */
    public static function getListData()
    {
        return ArrayHelper::map(
            static::find()->orderBy(['title' => SORT_ASC])->all(), 'id', 'title'
        );
    }

    /**
     * @return ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(PlaylistItem::class, ['playlist_id' => 'id'])
            ->with(['track'])
            ->orderBy(['track_number' => SORT_ASC]);
    }

    /**
     * Transformation of status attribute.
     * @return string
     */
    public function getStatusText()
    {
        return self::STATUS_DATA[$this->status];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'status'], 'required'],

            ['title', 'trim'],
            ['title', 'unique'],
            ['title', 'string', 'max' => 100],
            ['status', 'in', 'range' => array_keys(self::STATUS_DATA)],
            ['status', 'validateItemExists'],
        ];
    }

    /**
     * Validates whether item exists.
     * @param string $attribute
     */
    public function validateItemExists($attribute)
    {
        if (self::STATUS_INCOMPLETE !== (int)$this->status) {
            $message = 'You can not publish/private because the item does not exist in this playlist.';

            if ($this->isNewRecord) {
                $this->addError($attribute, $message);
            }
            if (!$this->isNewRecord && empty(static::findOne($this->id)->items)) {
                $this->addError($attribute, $message);
            }
        }
    }

    /**
     * @param int $id
     */
    public static function saveFrequency($id)
    {
        $frequency = (int)PlaylistItem::find()
            ->where(['playlist_id' => $id])
            ->count();

        $model = static::findOne($id);
        if (null !== $model) {
            $model->frequency = $frequency;
            $model->save();
        }
    }

    /**
     * @param int $id
     */
    public static function toIncomplete($id)
    {
        $model = static::findOne($id);
        if (null !== $model) {
            $model->status = self::STATUS_INCOMPLETE;
            $model->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_DELETE,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }
        PlaylistItem::removePlaylists($this->id);
        return true;
    }
}

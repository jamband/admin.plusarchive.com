<?php

declare(strict_types=1);

namespace app\models;

use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $auth_key
 * @property int $created_at
 * @property int $updated_at
 *
 * @property string $authKey
 */
class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName(): string
    {
        return 'user';
    }

    public static function findIdentity($id): self|null
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername(string $username): self|null
    {
        return static::findOne(['username' => $username]);
    }

    public function getId(): mixed
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword(string $password): bool
    {
        return security()->validatePassword($password, $this->password);
    }

    public function setPassword(string $password): void
    {
        $this->password = security()->generatePasswordHash($password);
    }

    public function setAuthKey(): void
    {
        $this->auth_key = security()->generateRandomString();
    }

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }
}

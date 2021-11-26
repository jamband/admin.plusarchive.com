<?php

declare(strict_types=1);

namespace app\components;

use Hashids\Hashids as HashidsBase;
use yii\base\BaseObject;

class Hashids extends BaseObject
{
    public string $salt;

    public int $minHashLength;

    public string $alphabet;

    private HashidsBase $_hashids;

    public function init(): void
    {
        parent::init();

        $this->_hashids = new HashidsBase(
            $this->salt,
            $this->minHashLength,
            $this->alphabet
        );
    }

    public function __call($name, $params): mixed
    {
        if (method_exists($this->_hashids, $name)) {
            return call_user_func_array([$this->_hashids, $name], $params);
        }

        return parent::__call($name, $params);
    }

    public function decode(string $id): int
    {
        $id = $this->_hashids->decode($id);

        if (1 === count($id)) {
            return $id[0];
        }

        return 0;
    }
}

<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\components;

use Hashids\Hashids as HashidsBase;
use yii\base\BaseObject;

/**
 * Yii 2 wrapper for the Hashids.
 * @link https://github.com/lichunqiang/hashids
 */
class Hashids extends BaseObject
{
    /**
     * @var string
     */
    public $salt;

    /**
     * @var int
     */
    public $minHashLength;

    /**
     * @var string
     */
    public $alphabet;

    /**
     * @var HashidsBase
     */
    private $_hashids;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->_hashids = new HashidsBase(
            $this->salt,
            $this->minHashLength,
            $this->alphabet
        );
    }

    /**
     * {@inheritdoc}
     */
    public function __call($name, $params)
    {
        if (method_exists($this->_hashids, $name)) {
            return call_user_func_array([$this->_hashids, $name], $params);
        }
        return parent::__call($name, $params);
    }

    /**
     * @param string $id
     * @return int|int[]
     */
    public function decode($id)
    {
        $id = $this->_hashids->decode($id);
        if (1 === count($id)) {
            return $id[0];
        }
        return $id;
    }
}

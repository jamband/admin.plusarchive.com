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
use yii\base\Object;

/**
 * Yii 2 wrapper for the Hashids.
 * @link https://github.com/lichunqiang/hashids
 */
class Hashids extends Object
{
    /**
     * @var string
     */
    public $salt;

    /**
     * @var integer
     */
    public $minHashLength;

    /**
     * @var string
     */
    public $alphabet;

    private $_hashids;

    /**
     * @inheritdoc
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
     * @inheritdoc
     */
    public function __call($name, $params)
    {
        return method_exists($this->_hashids, $name)
            ? call_user_func_array([$this->_hashids, $name], $params)
            : parent::__call($name, $params);
    }

    /**
     * @param string $id
     * @return integer|array
     */
    public function decode($id)
    {
        $id = $this->_hashids->decode($id);
        return 1 === count($id) ? $id[0] : $id;
    }
}

<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\models\common;

/**
 * @property integer $created_at
 */
trait DataTransformationTrait
{
    /**
     * Whether the recently added data. (within one month)
     * @return null|string
     */
    public function getNewText()
    {
        return time() - $this->created_at <= 2592000 ? 'New' : null;
    }
}

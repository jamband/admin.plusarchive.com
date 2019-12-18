<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\models\query;

trait ActiveQueryTrait
{
    /**
     * @param string $column
     * @return self
     */
    public function latest(string $column = 'created_at'): self
    {
        return $this->orderBy([$column => SORT_DESC]);
    }

    /**
     * @param string $column
     * @return self
     */
    public function oldest(string $column = 'created_at'): self
    {
        return $this->orderBy([$column => SORT_ASC]);
    }
}

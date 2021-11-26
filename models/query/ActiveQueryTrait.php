<?php

declare(strict_types=1);

namespace app\models\query;

trait ActiveQueryTrait
{
    public function latest(string $column = 'created_at'): self
    {
        return $this->orderBy([$column => SORT_DESC]);
    }

    public function oldest(string $column = 'created_at'): self
    {
        return $this->orderBy([$column => SORT_ASC]);
    }
}

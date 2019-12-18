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

namespace app\components;

use Yii;
use yii\base\InvalidConfigException;
use yii\data\Sort as SortBase;
use yii\data\Pagination;
use yii\web\Request;

class Sort extends SortBase
{
    /**
     * @param string $attribute
     * @param bool $absolute
     * @return string
     * @throws InvalidConfigException
     */
    public function createUrl($attribute, $absolute = false): string
    {
        $params = $this->params;

        if (null === $params) {
            $request = Yii::$app->getRequest();
            $params = $request instanceof Request ? $request->getQueryParams() : [];
        }

        $pagination = new Pagination;

        if (isset($params[$pagination->pageParam])) {
            unset($params[$pagination->pageParam]);
        }

        $params[$this->sortParam] = $this->createSortParam($attribute);

        $params[0] = null === $this->route
            ? Yii::$app->controller->getRoute()
            : $this->route;

        $urlManager = null === $this->urlManager
            ? Yii::$app->getUrlManager()
            : $this->urlManager;

        return $absolute
            ? $urlManager->createAbsoluteUrl($params)
            : $urlManager->createUrl($params);
    }
}

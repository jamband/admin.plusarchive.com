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

use Yii;
use yii\data\Sort as SortBase;
use yii\data\Pagination;
use yii\web\Request;

class Sort extends SortBase
{
    /**
     * {@inheritdoc}
     */
    public function createUrl($attribute, $absolute = false)
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

<?php

declare(strict_types=1);

namespace app\components;

use Yii;
use yii\data\Pagination;
use yii\data\Sort as SortBase;
use yii\web\Request;

class Sort extends SortBase
{
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

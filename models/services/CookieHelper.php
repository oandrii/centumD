<?php

namespace app\models\services;

use Yii;
use yii\base\Model;

class CookieHelper extends Model
{
    public static function setCookie($model)
    {
        $cookies = Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name' => 'mainCookie',
            'value' => ['count' => 0, 'limit' => $model->limit, 'link' => $model->link, 'time' => $model->time],
            'expire' => time() + $model->time * 3600,
        ]));
    }

    public static function addCount($cookieName)
    {
        $cookies = Yii::$app->request->cookies;
        if (isset($cookies['mainCookie'])) {
            $count = $cookies['mainCookie']->value['count'] + 1;
            $limit = $cookies['mainCookie']->value['limit'];
            $link = $cookies['mainCookie']->value['link'];
            $time = $cookies['mainCookie']->value['time'] ?? 1;

            if ($count > $limit && $limit != 0) {
                return '404';
            }

            $cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
                'name' => 'mainCookie',
                'value' => ['count' => $count, 'limit' => $limit, 'link' => $link],
                'expire' => time() + $time * 3600,
            ]));
        }
    }
}
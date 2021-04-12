<?php

namespace app\controllers;

use app\models\services\CookieHelper;
use app\models\services\LinkHelper;
use Yii;
use yii\web\Controller;
use app\models\EntryForm;

class InputController extends Controller
{

    public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $cookie = new CookieHelper();
            $cookie->setCookie($model);

            $result = LinkHelper::getShortLink($model);

            return $this->render('entry-confirm', ['shortLink' => $result]);
        } else {
            return $this->render('entry', ['model' => $model]);
        }
    }

    public function actionRedirect()
    {
        $cookies = Yii::$app->request->cookies;

        if ($cookies->has('mainCookie')) {
            if (CookieHelper::addCount('mainCookie') == '404') {
                return $this->render('404');
            }
            return $this->redirect($cookies['mainCookie']->value['link']);
        } else {
            return $this->render('404');
        }
    }

}
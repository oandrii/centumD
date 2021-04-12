<?php

namespace app\models\services;

use yii\base\Model;

class LinkHelper extends Model
{
    private static $permittedChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    private static $tokenLength = 4;

    public static function getShortLink($model)
    {
        $actualLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $parsedUrl = parse_url($actualLink);
        $host = explode('.', $parsedUrl['host']);

        $token = self::generateShortLink();
        $link = $model->link;

        $shortLink = "http://" . $host[0] . "/" . $token;
        $redirect =  "/input/redirect";
        return ['link' => $link, 'shortLink' => $shortLink, 'host' => $redirect];
    }

    private static function generateShortLink()
    {
        $randomString = '';
        for ($i=0; $i < self::$tokenLength; $i++)
        {
            $randomString .= self::$permittedChars[mt_rand(0, strlen(self::$permittedChars))];
        }
        return $randomString;
    }
}
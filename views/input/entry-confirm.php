<?php
use yii\helpers\Html;
$this->title = 'Short Link';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>Here is your link</p>

<ul>
    <li>
        <label>
            Link
        </label>: <?= Html::tag('a', Html::encode($shortLink['shortLink']), ['href' => $shortLink['host'] ]) ?>
    </li>
</ul>
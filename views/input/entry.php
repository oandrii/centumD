<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Input';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'link')->textInput(['placeholder' => 'start with https:// or http://']) ?>

<?= $form->field($model, 'limit')->textInput(['placeholder' => 'limit of clicks. 0 to disable']) ?>

<?= $form->field($model, 'time')->textInput(['placeholder' => 'lifetime of the link in hours']) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
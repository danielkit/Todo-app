<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Register';

if (!empty($this->title))
{
    $this->params['breadcrumbs'][] = $this->title;
}

?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'age') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-lg']) ?>
    </div>

<?php ActiveForm::end(); ?>

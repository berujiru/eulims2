<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\referral\CancelledreferralSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cancelledreferral-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cancelledreferral_id') ?>

    <?= $form->field($model, 'referral_id') ?>

    <?= $form->field($model, 'reason') ?>

    <?= $form->field($model, 'cancel_date') ?>

    <?= $form->field($model, 'agency_id') ?>

    <?php // echo $form->field($model, 'cancelled_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

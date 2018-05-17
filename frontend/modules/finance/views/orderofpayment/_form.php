<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\finance\Collectiontype;
use common\models\finance\Paymentmode;
use common\models\lab\Customer;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\finance\Orderofpayment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orderofpayment-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="alert alert-info" style="background: #d9edf7 !important;margin-top: -20px !important;">
     <a href="#" class="close" data-dismiss="alert" >×</a>
    <p class="note" style="color:#265e8d">Fields with <i class="fa fa-asterisk text-danger"></i> are required.</p>
    </div>
    <div class="row">
        <div class="col-sm-6">
       <?php 

            echo $form->field($model, 'collectiontype_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Collectiontype::find()->all(), 'collectiontype_id', 'natureofcollection'),
            'theme' => Select2::THEME_BOOTSTRAP,
            'options' => ['placeholder' => 'Select Collection Type ...'],
            'pluginOptions' => [
              'allowClear' => true
            ],
            ]);
        ?>
        </div>   
        <div class="col-sm-6">
         <?php
         echo $form->field($model, 'order_date')->widget(DatePicker::classname(), [
         'options' => ['placeholder' => 'Select Date ...'],
         'type' => DatePicker::TYPE_COMPONENT_APPEND,
             'pluginOptions' => [
                 'format' => 'yyyy-mm-dd',
                 'todayHighlight' => true,
                 'autoclose'=>true
             ]
         ]);
         ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
        <?php
            echo $form->field($model, 'customer_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Customer::find()->all(), 'customer_id', 'customer_name'),
            'theme' => Select2::THEME_BOOTSTRAP,
            'options' => ['placeholder' => 'Select a customer ...'],
            'pluginOptions' => [
              'allowClear' => true
            ],
            'pluginEvents' => [
                "change" => "function() {
                    var customer_id=$(this).val();
                    $('#prog').show();
                    $('#requests').hide();
                    jQuery.ajax( {
                        type: \"POST\",
                        data: {
                            customer_id:customer_id,
                        },
                        url: \"/finance/orderofpayment/getlistrequest\",
                        dataType: \"text\",
                        success: function ( response ) {
                           
                           setTimeout(function(){
                           $('#prog').hide();
                             $('#requests').show();
                           $('#requests').html(response);
                               }, 1500);

                           
                        },
                        error: function ( xhr, ajaxOptions, thrownError ) {
                            alert( thrownError );
                        }
                    });   
                 }",
             ], 
            ]);
         ?>
        </div>
         <div class="col-sm-6">
        <?php
            echo $form->field($model, 'payment_mode_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Paymentmode::find()->all(), 'payment_mode_id', 'payment_mode'),
            'theme' => Select2::THEME_BOOTSTRAP,
            'options' => ['placeholder' => 'Select Payment Mode ...'],
            'pluginOptions' => [
              'allowClear' => true
            ],
            ]);
         ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">  
             <div id="prog" style="position:relative;display:none;">
                <img style="display:block; margin:0 auto;" src="<?php echo  $GLOBALS['frontend_base_uri']; ?>/images/ajax-loader.gif">
                 </div>
            <div id="requests" style="padding:15px!important;">    	
               <?php //echo $this->renderAjax('_request', ['dataProvider'=>$dataProvider]); ?>
            </div> 
        </div>
    </div> 
   
    <?= $form->field($model, 'purpose')->textarea(['maxlength' => true]); ?>

   
    

    <div class="form-group pull-right">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php if(Yii::$app->request->isAjax){ ?>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <?php } ?>
    </div>
    <br>
    <?php ActiveForm::end(); ?>

</div>

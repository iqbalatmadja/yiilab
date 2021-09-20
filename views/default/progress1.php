<br/>
<div>
  <input type="button" id="progress1" value="Progress 1"/>
</div>

<br/>
<button id="load">Load It!</button>
<div class="modal js-loading-bar">
 <div class="modal-dialog">
   <div class="modal-content">
     <div class="modal-body">
       <h2>On Progress</h2>
       <div class="progress progress-popup">
        <div class="progress-bar"></div>
       </div>
     </div>
   </div>
 </div>
</div>
<?php
$assetUrl = Yii::app()->getModule('yiilab')->getAssetsUrl();
Yii::app()->clientScript->registerScriptFile($assetUrl.'/js/bootstrap-waitingfor.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile($assetUrl.'/bootstrap/dist/css/bootstrap.min.css');
Yii::app()->clientScript->registerScriptFile($assetUrl.'/bootstrap/dist/js/bootstrap.min.js', CClientScript::POS_END);

Yii::app()->clientScript->registerCss('addi222333', '
.progress-bar.animate {
   width: 100%;
}
');

$url1 = Yii::app()->createAbsoluteUrl('yiilab/default/progress1Process');

$script = <<< JS
$(function(){
  $(document).on("click", "#progress1", function (e) {
    e.preventDefault();
    waitingDialog.show('Please Wait a Moment...',{
      headerText: 'On Progress',

    });
    var url = "$url1";
    var data = {};
    Ajax.call(data, url, function(resp1){
        if(resp1.result == 1){
          alert(resp1.message);
        }else{
          alert(resp1.message);
        }
        waitingDialog.hide();

    });
  })

  $(document).on("click", "#load", function (e) {
    e.preventDefault();
    var modal = $('.js-loading-bar'),bar = modal.find('.progress-bar');
    modal.modal('show');
    bar.addClass('animate');

    var url = "$url1";
    var data = {};
    Ajax.call(data, url, function(resp1){
        if(resp1.result == 1){
          alert(resp1.message);
        }else{
          alert(resp1.message);
        }
        bar.removeClass('animate');
        modal.modal('hide');

    });
  })
});



// Setup
this.$('.js-loading-bar').modal({
  backdrop: 'animate',
  show: false
});

// $('#load').click(function() {
//   var modal = $('.js-loading-bar'),bar = modal.find('.progress-bar');
//   modal.modal('show');
//   bar.addClass('animate');
//
//   setTimeout(function() {
//     bar.removeClass('animate');
//     modal.modal('hide');
//   }, 1500);
// });

JS;
Yii::app()->clientScript->registerScript('rwefeddw3eer', $script, CClientScript::POS_END);
/**
 * EOF
 */

<form id="mainfrm" name="mainfrm" method="post">
  <div style="margin-top: 2em;">
    <input name="phone1" class="input-phone" type="text"/>
  </div>
  <div style="margin-top: 2em;">
    <input name="date1" class="date1" type="text"/>
  </div>
  <div style="margin-top: 2em;">
    <input name="time1" class="time1" type="text"/>
  </div>
  <div style="margin-top: 2em;">
    <input name="numeral1" id="numeral1" type="text"/>
  </div>
  <div style="margin-top: 2em;">
    <input type="submit" />
  </div>

</form>
<?php
$assetUrl = Yii::app()->getModule('yiilab')->getAssetsUrl();
Yii::app()->clientScript->registerScriptFile($assetUrl.'/cleave.js/dist/cleave.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile($assetUrl.'/cleave.js/dist/addons/cleave-phone.id.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCss('addi222333', '
');

//$urlView = Yii::app()->createAbsoluteUrl('/servicemanagement/schedules/view');

$script = <<< JS
var phone1 = new Cleave('.input-phone', {
    phone: true,
    phoneRegionCode: 'id'
});

var date1 = new Cleave('.date1', {
    date: true,
    delimiter: '-',
    datePattern: ['Y', 'm', 'd']
});

var time1 = new Cleave('.time1', {
    time: true,
    timePattern: ['h', 'm', 's']
});

var numeral1 = new Cleave('#numeral1', {
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
});

$("#mainfrm").submit(function(){
  $("#numeral1").val(numeral1.getRawValue());
  return true;
})

JS;
Yii::app()->clientScript->registerScript('rwefeddw3eer', $script, CClientScript::POS_END);
/**
 * EOF
 */

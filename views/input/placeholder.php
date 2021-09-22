<form id="mainfrm" name="mainfrm" method="post">
  <div style="margin-top: 2em;">
    <input name="phone1" id="phone1" class="input-phone" type="text" placeholder="input here"/>
  </div>
  <div style="margin-top: 2em;">
    <input type="submit" />
  </div>

</form>
<?php
$assetUrl = Yii::app()->getModule('yiilab')->getAssetsUrl();
Yii::app()->clientScript->registerScriptFile($assetUrl.'/superplaceholder.js/dist/superplaceholder.min.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile($assetUrl.'/cleave.js/dist/addons/cleave-phone.id.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCss('addi222333', '
');

//$urlView = Yii::app()->createAbsoluteUrl('/servicemanagement/schedules/view');

$script = <<< JS
const inst = superplaceholder({
	el: document.querySelector('input'),
	sentences: [ 'Something to show', 'Another thing to show'],
	options: {
		// delay between letters (in milliseconds)
		letterDelay: 100, // milliseconds
		// delay between sentences (in milliseconds)
		sentenceDelay: 1000,
		// should start on input focus. Set false to autostart
		startOnFocus: true, // [DEPRECATED]
		// loop through passed sentences
		loop: true,
		// Initially shuffle the passed sentences
		shuffle: true,
		// Show cursor or not. Shows by default
		showCursor: true,
		// String to show as cursor
		cursor: '|',
		// Control onFocus behaviour. Default is `superplaceholder.Actions.START`
    //onFocusAction: superplaceholder.Actions.[NOTHING|START|STOP]
		onFocusAction: superplaceholder.Actions.STOP,
		// Control onBlur behaviour. Default is `superplaceholder.Actions.STOP`
 		onBlurAction: superplaceholder.Actions.START
	}
});

$(function(){
  inst.start();
});
JS;
Yii::app()->clientScript->registerScript('rwefeddw3eer', $script, CClientScript::POS_END);
/**
 * EOF
 */

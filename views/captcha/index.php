<div id="frmContact">
	<div>
		<label>Captcha</label>
		<span id="captcha-info" class="info"></span><br/>
		<input type="text" name="captcha" id="captcha" class="demoInputBox"><br>
	</div>
	<div>
    <?php
    //$uri = Yii::app()->request->requestUri.'/imagecode';
		$uri = Yii::app()->createAbsoluteUrl('ajax/imagecode');
    ?>
		<img id="captcha_code" src="<?php echo $uri;?>" />
    <?php //echo 'SESSION:'.$_SESSION["captcha_code"];?>
		<button name="submit" class="btnRefresh" onClick="refreshCaptcha();">Refresh Captcha</button>
	</div>
	<div>
		<button name="submit" class="btnAction" onClick="sendContact();">Send</button>
	</div>
</div>

<?php
$assetUrl = Yii::app()->getModule('yiilab')->getAssetsUrl();
// Yii::app()->clientScript->registerScriptFile($assetUrl.'/libs/select2/dist/js/select2.min.js', CClientScript::POS_END);
// Yii::app()->clientScript->registerCssFile($assetUrl.'/libs/select2/dist/css/select2.min.css');

Yii::app()->clientScript->registerCss('addi222333', '
body{width:610px;}
#frmContact {border-top:#F0F0F0 2px solid;background:#FAF8F8;padding:10px;}
#frmContact div{margin-bottom: 15px}
#frmContact div label{margin-left: 5px}
.demoInputBox{padding:10px; border:#F0F0F0 1px solid; border-radius:4px;}
.error{background-color: #FF6600;border:#AA4502 1px solid;padding: 5px 10px;color: #FFFFFF;border-radius:4px;}
.success{background-color: #12CC1A;border:#0FA015 1px solid;padding: 5px 10px;color: #FFFFFF;border-radius:4px;}
.info{font-size:.8em;color: #FF6600;letter-spacing:2px;padding-left:5px;}
.btnAction{background-color:#2FC332;border:0;padding:10px 40px;color:#FFF;border:#F0F0F0 1px solid; border-radius:4px;}
.btnRefresh{background-color:#8B8B8B;border:0;padding:7px 10px;color:#FFF;float:left;}
');
$tokenValue = Yii::app()->request->csrfToken;
// $urlView = Yii::app()->createAbsoluteUrl('/servicemanagement/schedules/view');
$process = Yii::app()->createAbsoluteUrl('yiilab/captcha/process');
$script = <<< JS
$(function(){


});

function sendContact() {
	var valid;
	valid = validateContact();
	if(valid) {
		jQuery.ajax({
		url: "$process",
		data:{"captcha":$("#captcha").val(),'YII_CSRF_TOKEN' : '$tokenValue'},
		type: "POST",
		success:function(data){
		$("#mail-status").html(data);
		},
		error:function (){}
		});
	}
}

function validateContact() {
  var valid = true;
  $(".demoInputBox").css('background-color','');
  $(".info").html('');

  if(!$("#captcha").val()) {
    $("#captcha-info").html("(required)");
    $("#captcha").css('background-color','#FFFFDF');
    valid = false;
  }

  return valid;
}

function refreshCaptcha() {
  $("#captcha_code").attr("src","$uri");
}

JS;
Yii::app()->clientScript->registerScript('rwefeddw3eer', $script, CClientScript::POS_END);
/**
 * EOF
 */

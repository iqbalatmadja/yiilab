<?php 
$captchaUrl = Yii::app()->createAbsoluteUrl('/images/captcha.php?rand='.rand());
?>
<img src="<?php echo $captchaUrl;?>" id='captchaimg'>
<?php 
echo "<pre>";print_r($_SESSION);echo "</pre>";

?>


<?php
	//Merchant's account information
	$merchant_id = Yii::app()->params['2c2p_merchant_id'];		//Get MerchantID when opening account with 2C2P
	$secret_key = Yii::app()->params['2c2p_secretkey'];	//Get SecretKey from 2C2P PGW Dashboard

	//Transaction information
	$payment_description  = '2 days 1 night hotel room';
	$order_id  = time();
	$currency = Yii::app()->params['2c2p_currency'];
	$amount  = '000000250000';

	//Request information
	$version = Yii::app()->params['2c2p_version'];
	$payment_url = Yii::app()->params['2c2p_payment_url'];
	$result_url_1 = "http://localhost/devPortal/V3_UI_PHP_JT01_devPortal/result.php";

	//Construct signature string
	$params = $version.$merchant_id.$payment_description.$order_id.$currency.$amount.$result_url_1;
	$hash_value = hash_hmac('sha1',$params, $secret_key,false);	//Compute hash value

	echo 'Payment information:';
	echo '<html>
	<body>
	<form id="myform" method="post" action="'.$payment_url.'">
		<input type="hidden" name="version" value="'.$version.'"/>
		<input type="hidden" name="merchant_id" value="'.$merchant_id.'"/>
		<input type="hidden" name="currency" value="'.$currency.'"/>
		<input type="hidden" name="result_url_1" value="'.$result_url_1.'"/>
		<input type="hidden" name="hash_value" value="'.$hash_value.'"/>
		PRODUCT INFO : <input type="text" name="payment_description" value="'.$payment_description.'"  readonly/><br/>
		ORDER NO : <input type="text" name="order_id" value="'.$order_id.'"  readonly/><br/>
		AMOUNT: <input type="text" name="amount" value="'.$amount.'" readonly/><br/>
		<input type="submit" name="submit" value="Confirm" />
	</form>

	<script type="text/javascript">

	</script>
	</body>
	</html>';
?>

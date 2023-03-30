<h3>List sessions to clear sample: sdid,orderId,tcart (separated by comma, case sensitive)</h3>

<div>tcart : <?php print_r(Yii::app()->session['tcart']);?></div>
<form method="post" name="frm">
<input type="text" name="sessions"/>
<input type="submit"/>
</form>

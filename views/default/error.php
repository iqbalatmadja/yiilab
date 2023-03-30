<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = 'Error - ' . Yii::app()->name;
$this->breadcrumbs=array(
	'Error',
);
?>
<div class="container">
	<div class="alert" role="alert">
	  <h3 class="alert-heading">Error <?php echo $code; ?></h4>
	  <hr>
	  <h5 class="text-muted"><?php echo CHtml::encode($message); ?></h5>
	</div>
</div>

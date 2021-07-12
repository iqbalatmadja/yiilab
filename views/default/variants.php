<?php 
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/select2/select2.min.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/select2/select2-bootstrap.min.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/select2/select2.min.js');
?>

<select name="popbox_locker" id="popbox_locker_id" class="form-control">
    <option value="">Please Select a Locker</option>
    <?php 
    for($i=1;$i<=10;$i++){
        echo '<option value="'.$i.'">'.$i.'</option>';
    }
    ?>
</select>

<?php 
Yii::app()->clientScript->registerScript('script','
$(document).ready(function() {
    $("#popbox_locker_id").select2({
        theme : "bootstrap"
    });
});        
        
',CClientScript::POS_END);


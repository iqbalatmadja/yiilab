<?php echo str_repeat('<br/>',4);?>
<p id="basicExample">
    <input type="text" class="time start" /> to
    <input type="text" class="time end" />
</p>

<div class="form-group">
    <div class='col-sm-6'>
        <div class="form-group">
            <div class='input-group date' id='datetimepicker3'>
                <input type='text' class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
            </div>
        </div>
    </div>
</div>
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/libs/jonthornton-jquery-timepicker/jquery.timepicker.min.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/libs/jonthornton-jquery-timepicker/jquery.timepicker.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/libs/Datepair.js/dist/datepair.min.js', CClientScript::POS_END);


Yii::app()->clientScript->registerCss('mycew2ss', '

');
Yii::app()->clientScript->registerScript('myddjs9w', '
// initialize input widgets first
$("#basicExample .time").timepicker({
    "minTime": "09:00",
    "maxTime": "21:00",
    "timeFormat": "H:i",
    //"showDuration": true,
    "scrollDefault": "now",
    "step": function(i) {
        //return (i%2) ? 15 : 45;
        return 30;
    },
    //"forceRoundTime": true,
});


// initialize datepair
var basicExampleEl = document.getElementById("basicExample");
var datepair = new Datepair(basicExampleEl);

$("#datetimepicker3").datetimepicker({
    format: "LT"
});

', CClientScript::POS_END);

<?php 
echo str_repeat('<br/>',5);
?>
<script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

</script>
<div id="txt"></div>


<script>
$(document).ready(function(){
    startTime();
})

</script>


<style>
.time-frame {
    background-color: #000000;
    color: #ffffff;
    width: 300px;
    font-family: Arial;
}

.time-frame > div {
    width: 100%;
    text-align: center;
}

#date-part {
    font-size: 1.2em;
}
#time-part {
    font-size: 2em;
}
</style>
<div class='time-frame'>
    <div id='date-part'></div>
    <div id='time-part'></div>
</div>
<br>
<input type='button' id='stop-interval' value='Stop time' />

<script>
$(document).ready(function() {
    var interval = setInterval(function() {
        var momentNow = moment();
        $('#date-part').html(momentNow.format('YYYY MMMM DD') + ' '
                            + momentNow.format('dddd')
                             .substring(0,3).toUpperCase());
        $('#time-part').html(momentNow.format('A hh:mm:ss'));
    }, 100);
    
    $('#stop-interval').on('click', function() {
        clearInterval(interval);
    });
});
</script>
<?php
Yii::app()->clientScript->registerScriptFile( Yii::app()->baseUrl . '/libs/js/moment.js',CClientScript::POS_END );

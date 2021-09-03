<?php
class TestController extends Controller {
  public function actionIndex()
  {
    $x = Helpers::getXaxis('2021-08-01','2021-08-30');
    echo "<pre>";print_r($x);echo "</pre>";die;
    /*
    $sql =
    "SELECT DATE(cal.date) daydate FROM (
    SELECT SUBDATE('2021-08-30', INTERVAL 30 DAY) + INTERVAL xc DAY AS DATE
    FROM(
    SELECT @xi:=@xi+1 AS xc FROM(
    SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc1,
    (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc2,
    (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc3,
    (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc4,
    (SELECT @xi:=-1) xc0) xxc1) cal
    WHERE cal.date <= NOW()
    GROUP BY DATE(cal.date) ORDER BY DATE(cal.date) ASC";
    $dates = Yii::app()->db->createCommand($sql)->queryAll();
    echo "<pre>";print_r($dates);echo "</pre>";die;
    */
  }


}

/**
 *
 * EOF
*/

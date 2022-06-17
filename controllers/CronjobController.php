<?php
class CronjobController extends Controller {
  public function actionList()
  {
    $x = Crontab::getJobs();
    echo "<pre>";print_r($x);echo "</pre>";
  }

  public function actionRemove()
  {
    $x = Crontab::removeJob('* * * * * php /home/iqbal/XamppDocRoot/hagihara/config/yiic cronjob testCron --add=system added');
    echo "<pre>";print_r($x);echo "</pre>";
  }

  public function actionRemoveall()
  {
    $alljobs = Crontab::getJobs();
    if(!empty($alljobs)){
      foreach($alljobs as $a){
        $x = Crontab::removeJob($a);
      }
    }
    $x = Crontab::getJobs();
    echo "<pre>";print_r($x);echo "</pre>";
    // $x = Crontab::removeJob('* * * * * php /home/iqbal/XamppDocRoot/hagihara/config/yiic cronjob testCron --add=system added');
    // echo "<pre>";print_r($x);echo "</pre>";
  }

}

/**
 * EOF
*/

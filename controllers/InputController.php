<?php
class InputController extends Controller {
  public function actionIndex()
  {

  }

  public function actionMasking1()
  {
    if(isset($_POST)){
      echo "<pre>";print_r($_POST);echo "</pre>";
    }
    $this->render('masking1');
  }

  public function actionPlaceholder()
  {
    if(isset($_POST)){
      echo "<pre>";print_r($_POST);echo "</pre>";
    }
    $this->render('placeholder');
  }



}

/**
 *
 * EOF
*/

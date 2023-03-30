<?php
class CaptchaController extends Controller {
  public function actionIndex()
  {
    $this->render('index',[]);
  }

  

  public function actionProcess()
  {
    if($_POST["captcha"]==$_SESSION["captcha_code"]){
    	print "OK";
    } else {
      print "<p class='Error'>Enter Correct Captcha Code.</p>";
    }
  }

}

/**
 *
 * EOF
*/

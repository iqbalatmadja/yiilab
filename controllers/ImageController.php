<?php
class ImageController extends Controller {
  public function actionIndex()
  {

  }

  public function actionUpload1()
  {
    $this->render('upload1');
  }

  public function actionUpload2()
  {
    $this->render('upload2');
  }

  public function actionSaveImage()
  {
    $result = 0;
    $message = 'Something is wrong';

    $uploadUrl = Yii::app()->createAbsoluteUrl('upload');
    $uploadPath = 'upload';

    if (isset(Yii::app()->params['storage_path']) && ! empty(Yii::app()->params['storage_path'])) {
      $uploadPath = Yii::app()->params['storage_path'];
      $uploadUrl = Yii::app()->createAbsoluteUrl('image');
    }

    $data = Yii::app()->request->getPost('image','');

    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);
    $type = explode('/',$type);
    $message = rand(10000,90000).'_temp'.'.'.$type[1]; # temporary_name
    $result = 1;
    file_put_contents($uploadPath.'/product/'.$message, $data);

    $returnValue = ['result'=>$result,'message'=>$message];
    echo CJSON::encode($returnValue);
  }

  public function actionSubmit()
  {
    $temporaryName = Yii::app()->request->getPost('temporary_name','');
    $uploadPath = 'upload';
    if (isset(Yii::app()->params['storage_path']) && ! empty(Yii::app()->params['storage_path'])) {
      $uploadPath = Yii::app()->params['storage_path'];
    }
    $finalName = 'ID_'.$temporaryName;
    rename($uploadPath.'/product/'.$temporaryName,$uploadPath.'/product/'.$finalName);
  }

}

/**
 *
 * EOF
*/

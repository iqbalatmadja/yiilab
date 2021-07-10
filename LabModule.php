<?php
define('IS_SALESORDER_MODULE',1);
class LabModule extends CWebModule
{
	private $_assetsUrl;

	public function getAssetsUrl()
	{
		if ($this->_assetsUrl === null){
			$this->_assetsUrl = Yii::app()->getAssetManager()->publish(
				Yii::getPathOfAlias('yiilab.assets') );
		}
	  return $this->_assetsUrl;
	}

	public function init()
	{
		Yii::app()->clientScript->registerCoreScript('jquery');
		$this->layoutPath = Yii::getPathOfAlias('yiilab.views.layouts');
		$this->setImport(array(
			'yiilab.models.*',
			'yiilab.components.*',
		));
		
    Yii::app()->setComponent('inventory', array(
            'class' => 'core.components.CInventory'
    ));

		Yii::app()->clientScript->registerScript('initjssalesorder', '
		
		', CClientScript::POS_END);
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			Yii::app()->errorHandler->errorAction='yiilab/default/error';
            $this->layoutPath = Yii::getPathOfAlias('yiilab.views.layouts');
            $controller->layout = 'main';
			return true;
		}
		else
			return false;
	}
}

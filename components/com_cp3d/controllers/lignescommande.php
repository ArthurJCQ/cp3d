<?php
defined('_JEXEC') or die;

class Cp3dControllerLignesCommande extends JControllerForm
{
	protected function getReturnPage()
	{
		return JURI::base()."/index.php?option=com_cp3d&view=lignescommande";		
	}

	public function getModel($name = 'form', $prefix = '', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
}

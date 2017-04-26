<?php
defined('_JEXEC') or die('Restricted access');
 
class Cp3dControllerTypeimpressions extends JControllerAdmin
{
	// surcharge pour gérer la suppression de types d'impression par le modèle adéquat
	public function getModel($name = 'Typeimpression', $prefix = 'Cp3dModel') 
	{
		// récupère le modèle de détail ($name au singulier) pour la suppression assistée d'un (des) enregistrement(s)
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}

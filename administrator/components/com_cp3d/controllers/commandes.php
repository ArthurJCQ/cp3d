<?php
defined('_JEXEC') or die('Restricted access');
 
class Cp3dControllerCommandes extends JControllerAdmin
{
	// surcharge pour g�rer la suppression dde commandes par le mod�le ad�quat
	public function getModel($name = 'Commande', $prefix = 'Cp3dModel') 
	{
		// r�cup�re le mod�le de d�tail ($name au sigulier) pour la suppression assist�e d'un (des) enregistrement(s)
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}

<?php
defined('_JEXEC') or die('Restricted access');
 
class Cp3dControllerLigneCommandes extends JControllerAdmin
{
	// surcharge pour gérer la suppression de lignes de commande par le modèle adéquat
	public function getModel($name = 'LigneCommande', $prefix = 'Cp3dModel') 
	{
		// récupère le modèle de détail ($name au sigulier) pour la suppression assistée d'un (des) enregistrement(s)
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}

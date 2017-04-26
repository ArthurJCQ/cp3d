<?php
defined('_JEXEC') or die('Restricted access');
 
class Cp3dController extends JControllerLegacy
{
	function display($cachable = false, $urlparams = false) 
	{
		require_once JPATH_COMPONENT.'/helpers/modele.php';

		// affectation de la vue récupérée en paramètre
		$input = JFactory::getApplication()->input;
		$input->set('view', $input->getCmd('view', 'Modeles'));

		parent::display($cachable, $urlparams);		
		return $this;
	}
}

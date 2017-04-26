<?php
defined('_JEXEC') or die('Restricted access');
 
class Cp3dControllerEntreprise extends JControllerForm
{
	function display($cachable = false, $urlparams = false) 
	{
		$input = JFactory::getApplication()->input;
		$input->set('view', $input->getCmd('view', 'Entreprise'));

		parent::display($cachable, $urlparams);
	}
}

<?php
defined('_JEXEC') or die('Restricted access');
 
class Cp3dControllerCommande extends JControllerForm
{
	function display($cachable = false, $urlparams = false) 
    {
        $input = JFactory::getApplication()->input;
        $input->set('view', $input->getCmd('view', 'Commande'));

        parent::display($cachable, $urlparams);
    }
}
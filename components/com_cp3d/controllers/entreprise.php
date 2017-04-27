<?php
defined('_JEXEC') or die('Restricted access');
 
class Cp3dModelEntreprise extends JModelItem
{
	protected $_item = null;
	protected $_context = 'com_cp3d.entreprise';

	protected function populateState()
	{
		$app = JFactory::getApplication('site');
		
		// Charge et mémorise l'état (state) de l'id depuis le contexte
		$pk = $app->input->getInt('id');
		$this->setState($this->_context.'.id', $pk);
		// $this->setState('entreprise.id', $pk);
	}

	public function getItem($pk = null)
	{
		// Initialise l'id
		$pk = (!empty($pk)) ? $pk : (int) $this->getState($this->_context.'.id');

		// Si pas de données chargées pour cet id
		if (!isset($this->_item[$pk])) {
			$db = $this->getDbo();
			$query = $db->getQuery(true);
			$query->select('e.id, e.raisonSociale, e.alias, e.numSIRET, e.rib, e.published');
			$query->from('#__cp3d_entreprise e');
	
			$query->where('e.id = ' . (int) $pk);
			$db->setQuery($query);
			$data = $db->loadObject();
			$this->_item[$pk] = $data;
		}
  		return $this->_item[$pk];
	}
}

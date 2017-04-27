<?php

defined('_JEXEC') or die('Restricted access');
 
class Cp3dModelUtilisateur extends JModelItem
{
	protected $_item = null;
	protected $_context = 'com_cp3d.utilisateur';

	protected function populateState()
	{
		$app = JFactory::getApplication('site');
		
		// Charge et mémorise l'état (state) de l'id depuis le contexte
		$pk = $app->input->getInt('id');
		
		$this->setState($this->_context.'.id', $pk);
		// $this->setState('modele.id', $pk);
	}

	public function getItem($pk = null)
	{
		// Initialise l'id
		$pk = (!empty($pk)) ? $pk : (int) $this->getState($this->_context.'.id');
		//echo 'pk = '.$pk; //test de pk
		// Si pas de données chargées pour cet id
		if (!isset($this->_item[$pk])) {
			$db = $this->getDbo();
			$query	= $this->_db->getQuery(true);
		$query-> SELECT ('u.nom, u.prenom, u.alias, u.adr_rue, u.adr_ville, u.adr_CP, u.email, u.dateNaissance, u.created, e.raisonSociale, p.pays');
		$query->from('#__cp3d_utilisateur u, #__cp3d_entreprise e, #__cp3d_pays p');
		$query-> where('u.id='.$pk.'');
		$query-> AND ('u.idEntreprise=e.id');
		$query-> AND ('u.idPays=p.id');

			
			$db->setQuery($query);
			$data = $db->loadObject();
			$this->_item[$pk] = $data;

		}
  		return $this->_item[$pk];
	}
}

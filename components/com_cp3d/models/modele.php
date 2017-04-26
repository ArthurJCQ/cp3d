<?php
defined('_JEXEC') or die('Restricted access');
 
class Cp3dModelModele extends JModelItem
{
	protected $_item = null;
	protected $_context = 'com_cp3d.modele';

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

		// Si pas de données chargées pour cet id
		if (!isset($this->_item[$pk])) {
			$db = $this->getDbo();
			$query = $db->getQuery(true);
			$query->select('m.id, m.nom, m.alias, m.description, m.dossierImage, m.modele3D, m.idEtatModele, m.idTheme, m.idUtilisateur, m.hits');
			$query->from('#__cp3d_modele m');

			// joint la table theme
			$query->select('t.theme AS theme')->join('LEFT', '#__cp3d_theme AS t ON t.id=m.idTheme');

			// joint la table etatModele
			$query->select('e.etatModele AS etatModele')->join('LEFT', '#__cp3d_etatmodele AS e ON e.id=m.idEtatModele');

			// joint la table utilisateur (designer)
			$query->select('u.nom AS nomU')->join('LEFT', '#__cp3d_utilisateur AS u ON u.id=m.idUtilisateur');

			$query->where('m.id = ' . (int) $pk);
			$db->setQuery($query);
			$data = $db->loadObject();
			$this->_item[$pk] = $data;
		}
  		return $this->_item[$pk];
	}

	public function getTypes()
	{
		$query = $this->_db->getQuery(true);
		$query->select('t.prixUniteHT');
		$query->from('#__cp3d_typeimpression AS t');
		$query->select('m.materiau AS materiau')->join('LEFT', '#__cp3d_materiau AS m ON m.id=t.idMateriau');
		$query->where('t.idModele='.(int) $this->getState($this->_context.'.id'));
		$query->order('materiau ASC');
		$this->_db->setQuery($query);
		$types = $this->_db->loadObjectList();
		return $types;
	}
}

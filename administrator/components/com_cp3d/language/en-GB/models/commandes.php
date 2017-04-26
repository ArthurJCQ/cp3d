<?php
defined('_JEXEC') or die('Restricted access');

class Cp3dModelCommandes extends JModelList
{
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'c.id',
				'etat', 'ec.etat',
				'prenom', 'u.prenom',
				'nom', 'u.nom'
			);
		}
		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// récupère les informations de la session utilisateur nécessaires au paramétrage de l'écran
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$published = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		parent::populateState('c.id', 'desc');
	}

	protected function getListQuery()
	{
		$query = $this->_db->getQuery(true);
		$query->select('c.*');
		$query->select('ec.*');
		$query->select('u.*');
		$query->from('#__cp3d_commande c');
		$query->join('INNER', $this->_db->quoteName('#__cp3d_etatCommande', 'ec') . ' ON (' . $this->_db->quoteName('c.idEtatCommande') . ' = ' . $this->_db->quoteName('ec.id') . ')');
		$query->join('INNER', $this->_db->quoteName('#__cp3d_utilisateur', 'u') . ' ON (' . $this->_db->quoteName('c.idUtilisateur') . ' = ' . $this->_db->quoteName('u.id') . ')');

		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'id:'
			if (stripos($search, 'id:') === 0) {
				$query->where('c.id = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'u.nom LIKE '.$search;
				$searches[]	= 'u.prenom LIKE '.$search;
				$searches[]	= 'ec.etat LIKE '.$search;

				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('c.published=' . (int) $published);
		}
		elseif ($published === '') {
			$query->where('(c.published=0 OR c.published=1)');
		}

		$orderCol = $this->state->get('list.ordering', 'id');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		// echo nl2br(str_replace('#__','cp3d_',$query));			// TEST/DEBUG
		return $query;
	}
}

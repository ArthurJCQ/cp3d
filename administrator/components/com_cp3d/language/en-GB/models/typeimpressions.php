<?php
defined('_JEXEC') or die('Restricted access');

class Cp3dModelTypeimpressions extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 't.id',
				'idModele', 't.ilModele',
				'idMateriau', 't.idMateriau',
				'prixUniteHT', 't.prixUniteHT',
				'retribDesignerHT', 't.retribDesignerHT',
				'published', 't.published',
				'hits', 't.hits',
				'created', 't.created',
				'modified', 't.modified'
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

		parent::populateState('t.modified', 'desc');
	}
	
	protected function getListQuery()
	{
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('t.id, t.idMateriau, t.idModele, t.retribDesignerHT, t.prixUniteHT, t.published, t.hits, t.created, t.modified');
		$query->from('#__cp3d_typeimpression t');

		// joint les deux tables Modele et Materiau
		$query->select('m.materiau AS materiau')->join('LEFT', '#__cp3d_materiau AS m ON t.idMateriau=m.id');
		$query->select('d.nom AS modele')->join('LEFT', '#__cp3d_modele AS d ON t.idModele=d.id');

		// filtre de recherche rapide textuel
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'id:'
			if (stripos($search, 'id:') === 0) {
				$query->where('t.id = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'nom LIKE '.$search;
				$searches[]	= 'materiau LIKE '.$search;
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'id'); //id
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		//echo nl2br(str_replace('#__','cp3d_',$query));			// TEST/DEBUG
		return $query;
	}
}

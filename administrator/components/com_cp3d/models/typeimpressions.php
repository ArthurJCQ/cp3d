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
				'idModele', 't.idModele',
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

		// filtrer par modele
		$modele = $this->getUserStateFromRequest($this->context.'.filter.modele', 'filter_modele', '');
		$this->setState('filter.modele', $modele);

		// filtrer par materiau
		$materiau = $this->getUserStateFromRequest($this->context.'.filter.materiau', 'filter_materiau', '');
		$this->setState('filter.materiau', $materiau);

		parent::populateState('t.modified', 'desc');
	}
	
	protected function getListQuery()
	{
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('t.id, t.idMateriau, t.idModele, t.retribDesignerHT, t.prixUniteHT, t.published, t.hits, t.created, t.modified');
		$query->from('#__cp3d_typeimpression t');

		// joint les deux tables Modele et Materiau
		$query->select('m.materiau AS materiau_nom')->join('LEFT', '#__cp3d_materiau AS m ON t.idMateriau=m.id');
		$query->select('d.nom AS modele_nom')->join('LEFT', '#__cp3d_modele AS d ON t.idModele=d.id');

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

		// filtre selon l'état du filtre 'filter_published'
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('t.published=' . (int) $published);
		}
		elseif ($published === '') {
			// si aucune sélection, on n'affiche que les publié et dépublié
			$query->where('(t.published=0 OR t.published=1)');
		} 

		// Filter by idModele
		$modele = $this->getState('filter.modele');
		if (is_numeric($modele)) {
			$query->where('t.idModele=' . (int) $modele);
		}

		// Filter by idMateriau
		$materiau = $this->getState('filter.materiau');
		if (is_numeric($materiau)) {
			$query->where('t.idmateriau=' . (int) $materiau);
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'id'); //id
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		// echo nl2br(str_replace('#__','cp3d_',$query));		echo "<br><br>";	// TEST/DEBUG

		return $query;
	}

	// Recuperer les modeles
	public function getModeles()
	{
		$query = $this->_db->getQuery(true);
		$query->select('id, nom');
		$query->from('#__cp3d_modele');
		$query->order('nom ASC');
		$this->_db->setQuery($query);
		$modeles = $this->_db->loadObjectList();
		return $modeles;
	}

	// Recuperer les materiaux
	public function getMateriaux()
	{
		$query = $this->_db->getQuery(true);
		$query->select('id, materiau');
		$query->from('#__cp3d_materiau');
		$query->order('materiau ASC');
		$this->_db->setQuery($query);
		$materiaux = $this->_db->loadObjectList();
		return $materiaux;
	}
}

<?php
defined('_JEXEC') or die('Restricted access');

class Cp3dModelLigneCommandes extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'lc.id',
				'quantité', 'lc.quantite',
				'dateProduction', 'lc.dateProduction',
				'note', 'lc.note',
				'commentaire', 'lc.commentaire',
				'dateAvis', 'lc.dateAvis',
				'idEntreprise', 'lc.idCommande',
				'raisonSociale', 'e.raisonSociale',
				'idTypeImpression', 'lc.idTypeImpression',
				'idCommande', 'lc.idCommande',
				'published', 'lc.published',
				'hits', 'lc.hits',
				'modified', 'lc.modified'
			);
		}
		parent::__construct($config);
	}



	protected function populateState($ordering = null, $direction = null)
	{
		// récupère les informations de la session utilisateur nécessaires au paramétrage de l'écran
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$etat = $this->getUserStateFromRequest($this->context.'.filter.raisonSociale', 'filter_raisonSociale', '');
		$this->setState('filter.etat', $etat);



		$published = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		parent::populateState('modified', 'desc');
	}
	
	protected function getListQuery()
	{
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('lc.id, lc.quantite, lc.dateProduction, lc.note, lc.commentaire, lc.dateAvis, e.raisonSociale, lc.idCommande, lc.published,lc.idTypeImpression, lc.hits, lc.modified');
		$query->from('#__cp3d_ligneCommande lc')->join('LEFT', ' #__cp3d_entreprise AS e ON e.id=lc.idEntreprise');

		// joint la table pays
		//$query->select('p.pays AS pays')->join('LEFT', '#__cp3d_pays AS p ON p.id=e.pays_id');

		// filtre de recherche rapide textuel
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'id:'
			if (stripos($search, 'id:') === 0) {
				$query->where('lc.id = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'lc.id LIKE'.$search;
				$searches[]	= 'raisonSociale LIKE '.$search;
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// Filter by entreprise_id
		$raisonSociale = $this->getState('filter.raisonSociale');
		if (is_numeric($raisonSociale)) {
			$query->where('lc.idEntreprise=' . (int) $raisonSociale);
		}
		// filtre selon l'état du filtre 'filter_published'
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('lc.published=' . (int) $published);
		}
		elseif ($published === '') {
			// si aucune sélection, on n'affiche que les publié et dépublié
			$query->where('(lc.published=0 OR lc.published=1)');
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'id');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));
		// echo nl2br(str_replace('#__','egs_',$query));			// TEST/DEBUG
		return $query;
	}

	public function getEntreprises()
	{
		$query = $this->_db->getQuery(true);
		$query->select('id, raisonSociale');
		$query->from('#__cp3d_entreprise');
		$query->where('published=1');
		$query->order('raisonSociale ASC');
		$this->_db->setQuery($query);
		$entreprises = $this->_db->loadObjectList();
		return $entreprises;
	}	
}

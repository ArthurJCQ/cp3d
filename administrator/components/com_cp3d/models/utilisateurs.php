<?php
defined('_JEXEC') or die('Restricted access');

class Cp3dModelUtilisateurs extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'u.id',
				'nom', 'u.nom',
				'prenom', 'u.prenom',
				'rue', 'u.adr_rue',
				'ville', 'u.adr_ville',
				'cp', 'u.adr_CP',
				'pays', 'u.idPays',
				'email', 'u.email',
				'date_naissance', 'u.dateNaissance',
				'entreprise', 'u.idEntreprise',
				'published', 'u.published',
				'hits', 'u.hits',
				'modified', 'u.modified'
			);
		}
		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// récupère les informations de la session utilisateur nécessaires au paramétrage de l'écran
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$pay = $this->getUserStateFromRequest($this->context.'.filter.pay', 'filter_pay', '');
		$this->setState('filter.pay', $pay);

		$entreprise = $this->getUserStateFromRequest($this->context.'.filter.entreprise', 'filter_entreprise', '');
		$this->setState('filter.entreprise', $entreprise);

		$published = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);  

		parent::populateState('modified', 'desc');
	}
	
	protected function getListQuery()
	{
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('u.id, u.nom, u.prenom, u.adr_rue, u.adr_ville, u.adr_CP, u.idPays, u.email, u.dateNaissance, u.idEntreprise, u.published, u.hits, u.modified');
		$query->from('#__cp3d_utilisateur u');

		// joint la table entreprise
		$query->select('e.raisonSociale AS entreprise')->join('LEFT', '#__cp3d_entreprise AS e ON e.id=u.idEntreprise');

		// joint la table pays
		$query->select('p.pays AS pays')->join('LEFT', '#__cp3d_pays AS p ON p.id=u.idPays');

		// filtre de recherche rapide textuel
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'id:'
			if (stripos($search, 'id:') === 0) {
				$query->where('u.id = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'nom LIKE '.$search; // recherche par nom
				$searches[]	= 'prenom LIKE '.$search; // ou par prenom
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// Filter by idEntreprise
		$entreprise = $this->getState('filter.entreprise');
		if (is_numeric($entreprise)) {
			$query->where('u.idEntreprise=' . (int) $entreprise);
		}

		// Filter by Id
		$pays = $this->getState('filter.pay');
		if (is_numeric($pays)) {
			$query->where('u.idPays=' . (int) $pays);
		}
		

		
		// filtre selon l'état du filtre 'filter_published'
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('u.published=' . (int) $published);
		}
		elseif ($published === '') {
			// si aucune sélection, on n'affiche que les publié et dépublié
			$query->where('(u.published=0 OR u.published=1)');
		} 
		

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'id');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		// echo nl2br(str_replace('#__','cp3d_',$query)); 	// TEST/DEBUG
		return $query;
	}


	// Recuperer les pays
	public function getPays()
	{
		$query = $this->_db->getQuery(true);
		$query->select('id, pays');
		$query->from('#__cp3d_pays');
		$query->order('pays ASC');
		$this->_db->setQuery($query);
		$pays = $this->_db->loadObjectList();
		return $pays;
	}	

	// Recuperer les entreprises
	public function getEntreprises()
	{
		$query = $this->_db->getQuery(true);
		$query->select('id, raisonSociale');
		$query->from('#__cp3d_entreprise');
		$query->order('raisonSociale ASC');
		$this->_db->setQuery($query);
		$entreprise = $this->_db->loadObjectList();
		return $entreprise;
	}	
}

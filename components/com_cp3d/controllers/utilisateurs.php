<?php
defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.application.component.modellist');
 
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
				'alias', 'u.alias',
				'adr_rue', 'u.adr_rue',
				'adr_ville', 'u.adr_ville',
				'adr_CP', 'u.adr_CP',
				'pays', 'u.idPays',
				'email', 'u.email',
				'dateNaissance', 'u.dateNaissance',
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
		$app = JFactory::getApplication();

		// informations de pagination de la liste
		$limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'), 'uint');
		$this->setState('list.limit', $limit);

		$limitstart = $app->input->get('limitstart', 0, 'uint');
		$this->setState('list.start', $limitstart);

		// informations du tri de la liste
		$orderCol = $app->input->get('filter_order', $ordering);
		$this->setState('list.ordering', $orderCol);

		$listOrder = $app->input->get('filter_order_Dir', $direction);
		$this->setState('list.direction', $listOrder);
		
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		// filtre pour idEntreprise
		$entreprise = $this->getUserStateFromRequest($this->context.'.filter.entreprise', 'filter_entreprise');
		$this->setState('filter.entreprise', $entreprise);

		// filtre pour idPays
		$pays = $this->getUserStateFromRequest($this->context.'.filter.pays', 'filter_pays');
		$this->setState('filter.pays', $pays);

		parent::populateState('nom', 'ASC');
	}

	protected function _getListQuery()
	{

		$user = JFactory::getUser();               		// recupere l'objet courant utilisateur joomla
		$idCurrentUser = $user->id;						// recupere l'id utilisateur joomla
		$idCurrentGroup = 0;

		if (in_array('14', $user->groups)) { $idCurrentGroup = 1; } // 1 = CLIENT
		else if (in_array('15', $user->groups)) { $idCurrentGroup = 2; } // 2 = IMPRIMEUR
		else if (in_array('11', $user->groups)) { $idCurrentGroup = 3; } // 3 = DIRECTEUR
		else if (in_array('13', $user->groups)) { $idCurrentGroup = 4; } // 4 = DESIGNER
		switch ($idCurrentGroup) {
			case 3: //req directeur

			$query	= $this->_db->getQuery(true);
			$query-> SELECT ('u.id, u.nom, u.prenom, u.email, e.raisonSociale');
			$query->from('#__cp3d_utilisateur u, #__cp3d_entreprise e');
			$query->WHERE ('u.idEntreprise=e.id');

			case 4: //req designer

			//echo 'user courant =', $idCurrentUser; //ID USER COURANT
			$query	= $this->_db->getQuery(true);
			$query->SELECT ('u.id, u.nom, u.prenom, u.email, e.raisonSociale');
			$query->from('#__cp3d_utilisateur u');
			$query->join('inner','#__cp3d_entreprise e ON u.idEntreprise=e.id');
			$query->WHERE('u.id='.$idCurrentUser.'');

			case 2: //req imprimeur

			$query	= $this->_db->getQuery(true);
			$query->SELECT ('u.id, u.nom, u.prenom, u.email, e.raisonSociale');
			$query->from('#__cp3d_utilisateur u');
			$query->join('inner','#__cp3d_entreprise e ON u.idEntreprise=e.id');
			$query->WHERE('u.id='.$idCurrentUser.'');

			case 1: //req client

			$query	= $this->_db->getQuery(true);
			$query->SELECT ('u.id, u.nom, u.prenom, u.email, e.raisonSociale');
			$query->from('#__cp3d_utilisateur u');
			$query->join('inner','#__cp3d_entreprise e ON u.idEntreprise=e.id');
			$query->WHERE('u.id='.$idCurrentUser.'');

		}
		// filtre de recherche rapide textuelle
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
				$searches[]	= 'u.nom LIKE '.$search;
				$searches[]	= 'u.prenom LIKE '.$search;

				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// filtre les éléments publiés
		$query->where('u.published=1');

		// Filter by idEntreprise
		$etat = $this->getState('filter.etat');
		if (is_numeric($etat)) {
			$query->where('u.idEntreprise=' . (int) $etat);
		}

		// Filter by idPays
		$pays = $this->getState('filter.pays');
		if (is_numeric($pays)) {
			$query->where('u.idPays=' . (int) $pays);
		}


		
		// tri des colonnes
		$orderCol = $this->getState('list.ordering', 'nom');
		$orderDirn = $this->getState('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		 //echo nl2br(str_replace('#__','cp3d_',$query));	exit();		// TEST/DEBUG
		//var_dump($query);exit();
		return $query;
	}


	// Recuperer les etats
	public function getEntreprises()
	{
		$query = $this->_db->getQuery(true);
		$query->select('id, entreprise');
		$query->from('#__cp3d_eentreprise');
		$query->order('entreprise ASC');
		$this->_db->setQuery($query);
		$entreprises = $this->_db->loadObjectList();
		return $entreprises;
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
}

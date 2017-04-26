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

		parent::populateState('nom', 'ASC');
	}

	protected function _getListQuery()
	{
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('u.id, u.nom, u.prenom, u.adr_rue, u.adr_ville, u.adr_CP, u.idPays, u.email, u.dateNaissance, u.idEntreprise, u.published, u.hits, u.modified');
		$query->from('#__cp3d_utilisateur u');

		// joint la table pays
		$query->select('p.pays AS pays')->join('LEFT', '#__cp3d_pays AS p ON p.id=u.idPays');

		// joint la table entreprises
		$query->select('e.raisonSociale AS entreprise')->join('LEFT', '#__cp3d_entreprise AS e ON e.id=u.idEntreprise');		
		
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
				$searches[]	= 'p.pays LIKE '.$search;
				$searches[]	= 'e.raisonSociale LIKE '.$search;
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}
		
		// filtre les éléments publiés
		$query->where('u.published=1');
		
		// tri des colonnes
		$orderCol = $this->getState('list.ordering', 'nom');
		$orderDirn = $this->getState('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		// echo nl2br(str_replace('#__','egs_',$query));			// TEST/DEBUG
		return $query;
	}
}

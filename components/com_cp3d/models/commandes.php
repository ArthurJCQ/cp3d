<?php
defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.application.component.modellist');
 
class Cp3dModelCommandes extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'c.id',
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

		parent::populateState('id', 'ASC');
	}

	protected function _getListQuery()
	{
		$user = JFactory::getUser();               		// gets current user object
		$idCurrentUser = $user->id;						//Récupère l'id utilisateur joomla
		$idCurrentGroup = 0;				
		//Gestion des groupes
		if (in_array('14', $user->groups)) { $idCurrentGroup = 1; } //1 = CLIENT
		else if (in_array('15', $user->groups)) { $idCurrentGroup = 2; } //2 = IMPRIMEUR 
		else if (in_array('11', $user->groups)) { $idCurrentGroup = 3; } //3 = DIRECTEUR
		switch ($idCurrentGroup) { 
			case 1: //CLIENT
				// construit la requête d'affichage de la liste
				$query	= $this->_db->getQuery(true);
				$query->select('c.id, c.numCommande AS numCde, c.prixTotalTTC AS prix, cl.adr_rue AS adresse, c.idEtatCommande AS etat');
				$query->from('#__cp3d_commande c');
				// joint la table client à commande
				$query->select('cl.nom AS nom_client, cl.prenom AS prenom_client')->join('LEFT', '#__cp3d_utilisateur AS cl ON c.idUtilisateur=cl.id');
				//joint l'utilisateur joomla à l'utilisateur client
				$query->select('ju.id AS joomla_uid')->join('LEFT', '#__users AS ju ON cl.email = ju.email');
				$query->select('e.etat AS etat')->join('LEFT', '#__cp3d_etatCommande AS e ON c.idEtatCommande = e.id');
				// filtre de recherche rapide textuelle
				$search = $this->getState('filter.search');
				if (!empty($search)) {
					// recherche textuelle classique (sans préfixe)
					$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
					// Compile les clauses de recherche
					$searches	= array();
					$searches[]	= 'cl.nom LIKE '.$search;
					$searches[]	= 'cl.prenom LIKE '.$search;
					// Ajoute les clauses à la requête
					$query->where('('.implode(' OR ', $searches).')');
				}
				// filtre les éléments publiés
				$query->where('c.published=1');
				$query->where('ju.id = "' . $idCurrentUser . '"');
				// tri des colonnes
				$orderCol = $this->getState('list.ordering', 'id');
				$orderDirn = $this->getState('list.direction', 'ASC');
				$query->order($this->_db->escape($orderCol.' '.$orderDirn));
				//echo nl2br(str_replace('#__','cp3d_',$query));			// TEST/DEBUG
				return $query;
				break;
			case 2: //IMPRIMEUR
				break;
			case 3: //DIRECTEUR
				break;
		}
	}
}

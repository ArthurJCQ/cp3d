<?php
defined('_JEXEC') or die('Restricted access');

class Cp3dModelModeles extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'm.id',
				'nom', 'm.nom',
				'description', 'm.description',
				'dossierImage', 'm.dossierImage',
				'modele3D', 'm.modele3D',
				'etatModele', 'm.idEtatModele',
				'theme', 'm.idTheme',
				'utilisateur', 'm.idUtilisateur',
				'published', 'm.published',
				'hits', 'm.hits',
				'modified', 'm.modified',
			);
		}
		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// récupère les informations de la session utilisateur nécessaires au paramétrage de l'écran
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);


		// filtre pour etatModele
		$etat = $this->getUserStateFromRequest($this->context.'.filter.etat', 'filter_etat');
		$this->setState('filter.etat', $etat);

		// filtre pour theme
		$theme = $this->getUserStateFromRequest($this->context.'.filter.theme', 'filter_theme');
		$this->setState('filter.theme', $theme);

		// filtre pour utilisateur (designer)
		$utilisateur = $this->getUserStateFromRequest($this->context.'.filter.utilisateur', 'filter_utilisateur');
		$this->setState('filter.utilisateur', $utilisateur);

		$published = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		parent::populateState('nom', 'desc');
	}
	
	protected function getListQuery()
	{
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('m.id, m.nom, m.description, m.dossierImage, m.idEtatModele, m.idTheme, m.idUtilisateur, m.published, m.hits, m.modified');
		$query->from('#__cp3d_modele m');

		// joint la table theme
		$query->select('t.theme AS theme')->join('LEFT', '#__cp3d_theme AS t ON t.id=m.idTheme');

		// joint la table utilisateur
		$query->select('u.nom AS nomUtilisateur')->join('LEFT', '#__cp3d_utilisateur AS u ON u.id=m.idUtilisateur');

		// joint la table etatModele
		$query->select('e.etatModele AS etatModele')->join('LEFT', '#__cp3d_etatModele AS e ON e.id=m.idEtatModele');

		// filtre de recherche rapide textuel
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'id:'
			if (stripos($search, 'id:') === 0) {
				$query->where('m.id = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'nom LIKE '.$search; // recherche par nom
				$searches[]	= 'description LIKE '.$search; // ou par description
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}
		

	
		// Filter by idEtatModele
		$etat = $this->getState('filter.etat');
		if (is_numeric($etat)) {
			$query->where('m.idEtatModele=' . (int) $etat);
		}

		// Filter by idTheme
		$theme = $this->getState('filter.theme');
		if (is_numeric($theme)) {
			$query->where('m.idTheme=' . (int) $theme);
		}

		// Filter by idUtilisateur (designer)
		$utilisateur = $this->getState('filter.utilisateur');
		if (is_numeric($utilisateur)) {
			$query->where('m.idUtilisateur=' . (int) $utilisateur);
		}

		// filtre selon l'état du filtre 'filter_published'
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('m.published=' . (int) $published);
		}
		elseif ($published === '') {
			// si aucune sélection, on n'affiche que les publié et dépublié
			$query->where('(m.published=0 OR m.published=1)');
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'id');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		// echo nl2br(str_replace('#__','cp3d_',$query)); 	// TEST/DEBUG
		return $query;
	}
	
	// Recuperer les etats
	public function getEtats()
	{
		$query = $this->_db->getQuery(true);
		$query->select('id, etatModele');
		$query->from('#__cp3d_etatmodele');
		$query->order('etatModele ASC');
		$this->_db->setQuery($query);
		$etats = $this->_db->loadObjectList();
		return $etats;
	}	

	// Recuperer les themes
	public function getThemes()
	{
		$query = $this->_db->getQuery(true);
		$query->select('id, theme');
		$query->from('#__cp3d_theme');
		$query->order('theme ASC');
		$this->_db->setQuery($query);
		$themes = $this->_db->loadObjectList();
		return $themes;
	}	

	// Recuperer les utilisateurs (designers)
	public function getUtilisateurs()
	{
		$query = $this->_db->getQuery(true);
		$query->select('id, nom');
		$query->from('#__cp3d_utilisateur');
		$query->order('nom ASC');
		$this->_db->setQuery($query);
		$utilisateurs = $this->_db->loadObjectList();
		return $utilisateurs;
	}	
}

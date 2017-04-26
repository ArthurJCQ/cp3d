<?php
defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.application.component.modellist');
 
class Cp3dModelLignesCommande extends JModelList
{
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			/**
			 * @author n0dai <n0dai@hotmail.com>
			 * 
			 * Ici se trouve les différents critères pour l'ordre des résultats.
			 * J'ai décidé ici de n'utiliser que l'id, la quantite et la raison sociale
			 * de l'entreprise.
			 */
			$config['filter_fields'] = array(
				'id', 'lc.id',
				'quantite', 'lc.quantite',
				'raisonSociale', 'e.raisonSociale'			
			);
		}
		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication();

		$limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'), 'uint');
		$this->setState('list.limit', $limit);

		$limitstart = $app->input->get('limitstart', 0, 'uint');
		$this->setState('list.start', $limitstart);

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
		$query = $this->_db->getQuery(true);
		/**
		 * @author n0dai <n0dai@hotmail.com>
		 *
		 * Requête SQL
		 *
		 * Les tables utilisées : #__cp3d_ligneCommande
		 *                        #__cp3d_entreprise
		 *                        #__cp3d_typeImpression
		 *                        #__cp3d_modele
		 *
		 * $_GET['ic'] permet ici de récupérer l'id de la commande
		 * pour ensuite afficher dans la vue l'ensemble des articles
		 * relatifs à cette commande.
		 *
		 * L'url se présente donc de cette façon (en prenant l'exemple
		 * de la commande portant l'id 1) :
		 * 
		 * index.php/component/cp3d/?view=lignescommande&ic=1
		 */
		$query->select('lc.id, lc.quantite, lc.dateProduction, lc.note, lc.commentaire, lc.dateAvis, e.raisonSociale, lc.idCommande, lc.published, lc.idTypeImpression, lc.hits, lc.modified, m.nom');
		$query->from('#__cp3d_ligneCommande lc')->join('LEFT', ' #__cp3d_entreprise AS e ON e.id = lc.idEntreprise')->join('LEFT', ' #__cp3d_typeImpression AS ti ON lc.idTypeImpression = ti.id')->join('LEFT', ' #__cp3d_modele AS m ON m.id = ti.idModele')->where('lc.idcommande =' .$_GET['ic']);

		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('lc.id = '.(int) substr($search, 3));
			}
			else {
				/**
				 * @author n0dai <n0dai@hotmail.com>
				 *
				 * Ici se trouvent les critères pour la recherche d'un résultat.
				 * Les critères sont les suivants : la raison sociale d'une entreprise
				 *                                  le commentaire d'une ligne de commande
				 */
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				$searches	= array();
				$searches[]	= 'e.raisonSociale LIKE '.$search;
				$searches[]	= 'lc.commentaire LIKE '.$search;
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		$query->where('lc.published = 1');
		
		$orderCol = $this->getState('list.ordering', 'nom');
		$orderDirn = $this->getState('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		// echo nl2br(str_replace('#__','egs_',$query));			// TEST/DEBUG
		return $query;
	}
}

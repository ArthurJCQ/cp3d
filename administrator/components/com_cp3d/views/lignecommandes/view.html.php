	<?php
defined('_JEXEC') or die('Restricted access');
 
class Cp3dViewLigneCommandes extends JViewLegacy
{
	function display($tpl = null) 
	{
		// récupère la liste des items à afficher
		$this->items = $this->get('Items');
		// récupère l'objet jPagination correspondant à la liste
		$this->pagination = $this->get('Pagination');

		// récupère l'état des information de tri des colonnes
		$this->state = $this->get('State');
		$this->listOrder = $this->escape($this->state->get('list.ordering'));
		$this->listDirn	= $this->escape($this->state->get('list.direction'));			

		// récupère les paramêtres du fichier de configuration config.xml
		$params = JComponentHelper::getParams('com_cp3d');
		$this->paramDescShow = $params->get('jcp3d_show_desc', 0);
		$this->paramDescSize = $params->get('jcp3d_size_desc', 70);
		$this->paramDateFmt = $params->get('jcp3d_date_fmt', "d F Y");

		// affiche les erreurs éventuellement retournées
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		// ajoute la toolbar contenant les boutons d'actions
		$this->addToolBar();
		// invoque la méthode addSubmenu du fichier de soutien (helper)
		ModeleHelper::addSubmenu('lignecommandes');
		// prépare et affuche la sidebar à gauche de la liste
		$this->prepareSideBar();
		$this->sidebar = JHtmlSidebar::render();

		// affiche les calques par appel de la méthode display() de la classe parente
		parent::display($tpl);
	}
 
	protected function addToolBar() 
	{
		// affiche le titre de la page
		// JToolBarHelper::title('Gestion des lignes de commandes');
		JToolBarHelper::title(JText::_('COM_CP3D').' : '.JText::_('COM_CP3D_LIGNES_COMMANDE'));
		
		// affiche les boutons d'action
		JToolBarHelper::addNew('lignecommande.add');
		JToolBarHelper::editList('lignecommande.edit');
		JToolBarHelper::deleteList('COM_CP3D_CONFIRM_DELETION', 'lignecommandes.delete');
		JToolbarHelper::publish('lignecommandes.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('lignecommandes.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolbarHelper::archiveList('lignecommandes.archive');
		JToolbarHelper::checkin('lignecommandes.checkin');
		JToolbarHelper::trash('lignecommandes.trash');
		JToolbarHelper::preferences('COM_CP3D');
	}

	protected function prepareSideBar()
	{
		// definit l'action du formulaire sidebar
		JHtmlSidebar::setAction('index.php?option=COM_CP3D');
		
		// ajoute le filtre standard des statuts dans le bloc des sous-menus
		JHtmlSidebar::addFilter( JText::_('JOPTION_SELECT_PUBLISHED'), 'filter_published',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'),
			'value', 'text', $this->state->get('filter.published'),true)
		);

		// ajoute le filtre spécifique pour les entreprises
		$this->entreprises= $this->get('Entreprises');
		$options3	= array();
		foreach ($this->entreprises as $entreprise) {
			$options3[]	= JHtml::_('select.option', $entreprise->id,  $entreprise->raisonSociale);
		}
		$this->entreprise = $options3;
		JHtmlSidebar::addFilter("- ".JText::_('COM_CP3D_SELECT_ENTREPRISE')." -", 'filter_raisonSociale',
			JHtml::_('select.options', $this->entreprise,
			'value', 'text', $this->state->get('filter.raisonSociale'), true)
		);
	}

 	protected function getSortFields()
	{
		// prépare l'affichage des colonnes de tri du calque
		return array(
			'published' => JText::_('JSTATUS'),
			'nom' => JText::_('COM_CP3D_lignecommande_NOM'),
			'id' => "ID"
		);
	}  

	protected function displayEntreprises($currEntr) 
	{
		foreach ($this->entreprises as $entreprise) {
			if($entreprise->id==$currEntr) return $entreprise->entreprise;
		}
		return "N.C.";
	}
	
}

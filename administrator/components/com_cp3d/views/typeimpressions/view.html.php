<?php
defined('_JEXEC') or die('Restricted access');
 
class Cp3dViewTypeimpressions extends JViewLegacy
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
		ModeleHelper::addSubmenu('typeimpressions');
		// prépare et affiche la sidebar à gauche de la liste
		$this->prepareSideBar();
		$this->sidebar = JHtmlSidebar::render();

		// affiche les calques par appel de la méthode display() de la classe parente
		parent::display($tpl);
	}
 
	protected function addToolBar() 
	{
		// affiche le titre de la page
		// JToolBarHelper::title('Gestion des entreprises');
		JToolBarHelper::title(JText::_('COM_CP3D') . ' : ' . JText::_('COM_CP3D_TYPE_IMPRESSION'));
		
		// affiche les boutons d'action
		JToolBarHelper::addNew('typeimpression.add');
		JToolBarHelper::editList('typeimpression.edit');
		JToolBarHelper::deleteList('COM_CP3D_CONFIRM_DELETION', 'typeimpressions.delete');
		JToolbarHelper::publish('typeimpressions.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('typeimpressions.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolbarHelper::archiveList('typeimpressions.archive');
		JToolbarHelper::checkin('typeimpressions.checkin');
		JToolbarHelper::trash('typeimpressions.trash');
		JToolbarHelper::preferences('com_cp3d');
	}

	protected function prepareSideBar()
	{
		// definit l'action du formulaire sidebar
		JHtmlSidebar::setAction('index.php?option=com_cp3d&view=typeimpressions');
		
		// ajoute le filtre standard des statuts dans le bloc des sous-menus
		JHtmlSidebar::addFilter( JText::_('JOPTION_SELECT_PUBLISHED'), 'filter_published',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'),
			'value', 'text', $this->state->get('filter.published'),true)
		);

		// filtre spécifique par modele
		$this->modele = $this->get('Modeles');
		$options3	= array();
		foreach ($this->modele as $m) {
			$options3[]	= JHtml::_('select.option', $m->id,  $m->nom);
		}
		$this->modele = $options3;
		JHtmlSidebar::addFilter("- ".JText::_('COM_CP3D_SELECT_MODELE')."-", 'filter_modele', // constante COM_CP3D_SELECT_MODELE à ajouter
			JHtml::_('select.options', $this->modele,
			'value', 'text', $this->state->get('filter.modele'))
		); 

		// filtre spécifique par materiau
		$this->materiau = $this->get('Materiaux');
		$options3	= array();
		foreach ($this->materiau as $m) {
			$options3[]	= JHtml::_('select.option', $m->id,  $m->materiau);
		}
		$this->materiau = $options3;
		JHtmlSidebar::addFilter("- ".JText::_('COM_CP3D_SELECT_MATERIAU')."-", 'filter_materiau', // constante COM_CP3D_SELECT_MATERIAU à ajouter
			JHtml::_('select.options', $this->materiau,
			'value', 'text', $this->state->get('filter.materiau'))
		); 
	}

 	protected function getSortFields()
	{
		// prépare l'affichage des colonnes de tri du calque
		return array(
			'published' => JText::_('JSTATUS'),
			'nom' => JText::_('COM_CP3D_MODELE'),
			'id' => 'ID'
		);
	}  	
}

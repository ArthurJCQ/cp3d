<?php
defined('_JEXEC') or die('Restricted access');
  
class Cp3dViewUtilisateurs extends JViewLegacy
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
		ModeleHelper::addSubmenu('utilisateurs');
		// prépare et affuche la sidebar à gauche de la liste
		$this->prepareSideBar();
		$this->sidebar = JHtmlSidebar::render();

		// affiche les calques par appel de la méthode display() de la classe parente
		parent::display($tpl);
	}
 
	protected function addToolBar() 
	{
		// affiche le titre de la page
		// JToolBarHelper::title('Gestion des utilisateur');
		JToolBarHelper::title(JText::_('COM_CP3D').' : '.JText::_('COM_CP3D_UTILISATEURS'));
		// affiche les boutons d'action
		JToolBarHelper::addNew('utilisateur.add');
		JToolBarHelper::editList('utilisateur.edit');
		JToolBarHelper::deleteList('COM_CP3D_CONFIRM_DELETION', 'utilisateur.delete');
		JToolbarHelper::publish('utilisateur.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('utilisateur.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolbarHelper::archiveList('utilisateur.archive');
		JToolbarHelper::checkin('utilisateur.checkin');
		JToolbarHelper::trash('utilisateur.trash');
		JToolbarHelper::preferences('com_cp3d');
	}

	protected function prepareSideBar()
	{
		// definit l'action du formulaire sidebar
		JHtmlSidebar::setAction('index.php?option=com_cp3d&view=utilisateurs');
		
		// ajoute le filtre standard des statuts dans le bloc des sous-menus
		JHtmlSidebar::addFilter( JText::_('JOPTION_SELECT_PUBLISHED'), 'filter_published',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'),
			'value', 'text', $this->state->get('filter.published'),true)
		);

		
		// ajoute le filtre spécifique pour pays
		$this->pays = $this->get('Pays');
		$options3	= array();
		foreach ($this->pays as $p) {
			$options3[]	= JHtml::_('select.option', $p->id,  $p->pays);
		}
		$this->p = $options3;
		JHtmlSidebar::addFilter("- ".JText::_('COM_CP3D_SELECT_PAYS')."-", 'filter_pay',
			JHtml::_('select.options', $this->p,
			'value', 'text', $this->state->get('filter.pay'))
		); 

		// ajoute le filtre spécifique pour entreprise
		$this->entreprise = $this->get('Entreprises');
		$options3	= array();
		foreach ($this->entreprise as $ent) {
			$options3[]	= JHtml::_('select.option', $ent->id,  $ent->raisonSociale);
		}
		$this->entreprise = $options3;
		JHtmlSidebar::addFilter("- ".JText::_('COM_CP3D_SELECT_ENTREPRISE')."-", 'filter_entreprise',
			JHtml::_('select.options', $this->entreprise,
			'value', 'text', $this->state->get('filter.entreprise'))
		); 
	}

 	protected function getSortFields()
	{
		// prépare l'affichage des colonnes de tri du calque
		return array(
			'published' => JText::_('JSTATUS'),
			'nom' => JText::_('COM_CP3D_UTILISATEUR_NOM'),
			'id' => "ID",
		);
	}  


}

<?php
defined('_JEXEC') or die('Restricted access');
  
class Cp3dViewModeles extends JViewLegacy
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
		ModeleHelper::addSubmenu('modeles');
		// prépare et affuche la sidebar à gauche de la liste
		$this->prepareSideBar();
		$this->sidebar = JHtmlSidebar::render();

		// affiche les calques par appel de la méthode display() de la classe parente
		parent::display($tpl);
	}
 
	protected function addToolBar() 
	{
		// affiche le titre de la page
		// JToolBarHelper::title('Gestion des modeles');
		JToolBarHelper::title(JText::_('COM_CP3D').' : '.JText::_('COM_CP3D_MODELES'));
		// affiche les boutons d'action
		JToolBarHelper::addNew('modele.add');
		JToolBarHelper::editList('modele.edit');
		JToolBarHelper::deleteList('COM_CP3D_CONFIRM_DELETION', 'modeles.delete');
		JToolbarHelper::publish('modeles.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('modeles.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolbarHelper::archiveList('modeles.archive');
		JToolbarHelper::checkin('modeles.checkin');
		JToolbarHelper::trash('modeles.trash');
		JToolbarHelper::preferences('com_cp3d');
	}

	protected function prepareSideBar()
	{
		// definit l'action du formulaire sidebar
		JHtmlSidebar::setAction('index.php?option=com_cp3d&view=modeles');
		
		// ajoute le filtre standard des statuts dans le bloc des sous-menus
		
		JHtmlSidebar::addFilter( JText::_('JOPTION_SELECT_PUBLISHED'), 'filter_published',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'),
			'value', 'text', $this->state->get('filter.published'),true)
		);
		
		// ajoute le filtre spécifique pour etatModele
		$this->etatModele = $this->get('Etats');
		$options3	= array();
		foreach ($this->etatModele as $e) {
			$options3[]	= JHtml::_('select.option', $e->id,  $e->etatModele);
		}
		$this->e = $options3;
		JHtmlSidebar::addFilter("- ".JText::_('CP3D_ETAT_SELECT')."-", 'filter_etat', // Ajouter la constante CP3D_ETAT_SELECT  = "Selectionner un état"
			JHtml::_('select.options', $this->e,
			'value', 'text', $this->state->get('filter.etat'))
		);
		
		// ajoute le filtre spécifique pour utilisateur
		$this->utilisateur = $this->get('Utilisateurs');
		$options3	= array();
		foreach ($this->utilisateur as $u) {
			$options3[]	= JHtml::_('select.option', $u->id,  $u->nom);
		}
		$this->u = $options3;
		JHtmlSidebar::addFilter("- ".JText::_('CP3D_UTILISATEUR_SELECT')."-", 'filter_utilisateur', // Ajouter la constante  CP3D_UTILISATEUR_SELECT = "Selectionner un utilisateur"
			JHtml::_('select.options', $this->u,
			'value', 'text', $this->state->get('filter.utilisateur'))
		);

		// ajoute le filtre spécifique pour theme
		$this->theme = $this->get('Themes');
		$options3	= array();
		foreach ($this->theme as $t) {
			$options3[]	= JHtml::_('select.option', $t->id,  $t->theme);
		}
		$this->t = $options3;
		JHtmlSidebar::addFilter("- ".JText::_('CP3D_THEME_SELECT')."-", 'filter_theme', // Ajouter la constante CP3D_THEME_SELECT ="Selectionner un thème"
			JHtml::_('select.options', $this->t,
			'value', 'text', $this->state->get('filter.theme'))
		);
	}

 	protected function getSortFields()
	{
		// prépare l'affichage des colonnes de tri du calque
		return array(
			'published' => JText::_('JSTATUS'),
			'nom' => JText::_('COM_CP3D_MODELE_NOM'),
			'id' => "ID",
		);
	}  

}

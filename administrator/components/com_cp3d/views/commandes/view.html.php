<?php
defined('_JEXEC') or die('Restricted access');
 
class Cp3dViewCommandes extends JViewLegacy
{
	public function display($tpl = null) 
	{
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');

		$this->state = $this->get('State');
		$this->listOrder = $this->escape($this->state->get('list.ordering'));
		$this->listDirn	= $this->escape($this->state->get('list.direction'));

		$params = JComponentHelper::getParams('com_cp3d');

		$this->addToolBar();

		ModeleHelper::addSubmenu('commandes');
		$this->sidebar = JHtmlSidebar::render();

		$this->prepareSideBar();
		$this->sidebar = JHtmlSidebar::render();

		parent::display($tpl);
	}

	protected function addToolBar() 
	{
		JToolBarHelper::title(JText::_('COM_CP3D'). ' : ' .JText::_('COM_CP3D_COMMANDES'));
		
		JToolBarHelper::addNew('commande.add');
		JToolBarHelper::editList('commande.edit');
		JToolBarHelper::deleteList('COM_CP3D_CONFIRM_DELETION', 'commande.delete');
		JToolbarHelper::publish('commandes.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('commandes.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolbarHelper::archiveList('commandes.archive');
		JToolbarHelper::checkin('commandes.checkin');
		JToolbarHelper::trash('commandes.trash');

		JToolbarHelper::preferences('com_cp3d');
	}

	protected function prepareSideBar()
	{
		JHtmlSidebar::setAction('index.php?option=com_cp3d');
		
		JHtmlSidebar::addFilter( JText::_('JOPTION_SELECT_PUBLISHED'), 'filter_published',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'),
			'value', 'text', $this->state->get('filter.published'),true)
		);
	}

	protected function getSortFields()
	{
		// prépare l'affichage des colonnes de tri du calque
		return array(
			'published' => JText::_('JSTATUS'),
			'nom' => JText::_('COM_CP3D_NOM'),
			'id' => "ID"
		);
	}
}
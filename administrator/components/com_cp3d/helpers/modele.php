<?php
defined('_JEXEC') or die;

class ModeleHelper extends JHelperContent
{
	public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_CP3D_UTILISATEURS'),
			'index.php?option=com_cp3d&view=utilisateurs',
			$vName == 'utilisateurs'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_CP3D_ENTREPRISES'),
			'index.php?option=com_cp3d&view=entreprises',
			$vName == 'entreprises'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_CP3D_MODELES'),
			'index.php?option=com_cp3d&view=modeles',
			$vName == 'modeles'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_CP3D_TYPES_IMPRESSION'),
			'index.php?option=com_cp3d&view=typeimpressions',
			$vName == 'typeimpressions'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_CP3D_COMMANDES'),
			'index.php?option=com_cp3d&view=commandes',
			$vName == 'commandes'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_CP3D_LIGNES_COMMANDE'),
			'index.php?option=com_cp3d&view=lignecommandes',
			$vName == 'lignecommandes'
		);
	}
}

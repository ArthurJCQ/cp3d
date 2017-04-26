<?php
defined('_JEXEC') or die('Restricted Access');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

	<tr>
		<th width="5%" class="hidden-phone center">
				<?php echo JHtml::_('grid.checkall'); ?>
		</th>  
		<th width="15%" class="nowrap center">
				<?php echo JHtml::_('grid.sort', 'COM_CP3D_MODELE_NOM', 'm.nom', $listDirn, $listOrder) ?>
		</th>
		<th width="15%" class="nowrap center">
				<?php echo JHtml::_('grid.sort', 'COM_CP3D_MODELE_IMAGE', 'm.Image', $listDirn, $listOrder) ?>
		</th>
		<th width="15%" class="nowrap center hidden-phone">
				<?php echo JHtml::_('grid.sort', 'COM_CP3D_MODELE_DESIGNER', 'm.idUtilisateur', $listDirn, $listOrder) ?>
		</th>
		<th width="15%" class="nowrap center hidden-phone">
				<?php echo JHtml::_('grid.sort', 'COM_CP3D_MODELE_THEME', 'm.idTheme', $listDirn, $listOrder) ?>
		</th>
		<th width="15%" class="nowrap center hidden-phone">
				<?php echo JHtml::_('grid.sort', 'COM_CP3D_MODELE_ETAT', 'm.idEtatModele', $listDirn, $listOrder) ?>
		</th>
		<th width="15%" class="nowrap center hidden-tablet hidden-phone">
				<?php echo JHtml::_('grid.sort', 'COM_CP3D_PUBLISHED', 'm.published', $listDirn, $listOrder) ?>
		</th>
		<th width="5%" class="nowrap center hidden-tablet hidden-phone ">
				<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'm.id', $listDirn, $listOrder); ?>
		</th>              
	</tr>


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
			<?php echo JHtml::_('grid.sort', 'COM_CP3D_UTILISATEUR_NOM', 'u.nom', $listDirn, $listOrder) ?>
		</th>
		<th width="15%" class="nowrap center">
			<?php echo JHtml::_('grid.sort', 'COM_CP3D_UTILISATEUR_PRENOM', 'u.prenom', $listDirn, $listOrder) ?>
		</th>    
		<th width="15%" class="nowrap center hidden-phone">
			<?php echo JHtml::_('grid.sort', 'COM_CP3D_UTILISATEUR_EMAIL', 'u.email', $listDirn, $listOrder) ?>
		</th>
		<th width="15%" class="nowrap center hidden-tablet hidden-phone">
			<?php echo JHtml::_('grid.sort', 'COM_CP3D_UTILISATEUR_ENTREPRISE', 'u.idEntreprise', $listDirn, $listOrder) ?>
		</th>
		<th width="15%" class="nowrap center hidden-tablet hidden-phone">
			<?php echo JHtml::_('grid.sort', 'COM_CP3D_UTILISATEUR_ADR_PAYS', 'u.idPays', $listDirn, $listOrder) ?>
		</th>
		<th width="10%" class="nowrap center hidden-phone">
			<?php echo JHtml::_('grid.sort', 'Publié', 'u.published', $listDirn, $listOrder) ?>
		</th>
		<th width="10%" class="hidden-phone nowrap center">
			<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'u.id', $listDirn, $listOrder); ?>
		</th>     
	</tr>


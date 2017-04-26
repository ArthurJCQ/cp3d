<?php
defined('_JEXEC') or die('Restricted Access');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

<tr>
	<th class="hidden-phone">
		<?= JHtml::_('grid.checkall'); ?>
	</th> 
    <th class="nowrap">
		<?= JHtml::_('grid.sort', 'COM_CP3D_COMMANDE_NUMERO', 'c.numCommande', $listDirn, $listOrder); ?>
	</th>   
	<th class="nowrap">
		<?= JHtml::_('grid.sort', 'COM_CP3D_COMMANDE_ETAT', 'ec.etat', $listDirn, $listOrder); ?>
	</th>   
	<th class="nowrap hidden-phone">
		<?= JHtml::_('grid.sort', 'COM_CP3D_UTILISATEUR_PRENOM', 'u.prenom', $listDirn, $listOrder); ?>
	</th>
	<th class="nowrap hidden-phone">
		<?= JHtml::_('grid.sort', 'COM_CP3D_UTILISATEUR_NOM', 'u.nom', $listDirn, $listOrder); ?>
	</th> 
	<th width="1%" class="nowrap hidden-phone">
        <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'c.id', $listDirn, $listOrder); ?>
    </th>    
</tr>
<?php
defined('_JEXEC') or die('Restricted Access');

$listOrder      = $this->escape($this->state->get('list.ordering'));
$listDirn       = $this->escape($this->state->get('list.direction'));
?>

        <tr>
        <th class="center">
                <?php echo JHtml::_('grid.checkall'); ?>
        </th>   
        <th class="center">
                <?php echo JHtml::_('grid.sort', 'COM_CP3D_LIGNE_COMMANDE_QUANTITE', 'a.quantite', $listDirn, $listOrder) ?>
        </th>
		
		 <th class="center">
                <?php echo JHtml::_('grid.sort', 'COM_CP3D_COMMANDE_NUMERO', 'a.numCommande', $listDirn, $listOrder) ?>
        </th>
        
        <th class="center">
                <?php echo JHtml::_('grid.sort', 'COM_CP3D_LIGNE_COMMANDE_DATE_PROD', 'a.dateProduction', $listDirn, $listOrder) ?>
        </th>
        <th class="center">
                <?php echo JHtml::_('grid.sort', 'COM_CP3D_LIGNE_COMMANDE_ENTREPRISE', 'a.raisonSociale', $listDirn, $listOrder) ?>
        </th>
        
        <th class="nowrap">
                <?php echo JHtml::_('grid.sort', 'COM_CP3D_LIGNE_COMMANDE_TYPE_IMPRESSION', 'a.idTypeImpression', $listDirn, $listOrder) ?>
        </th>

        <th class="center ">
                <?php echo JHtml::_('grid.sort', 'Publié', 'a.published', $listDirn, $listOrder) ?>
        </th>
        <th class="center">
                <?php echo JHtml::_('grid.sort', 'JGLOBAL_HITS', 'a.hits', $listDirn, $listOrder); ?>
        </th>
        <th class="center">
                <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
        </th>
        </tr>
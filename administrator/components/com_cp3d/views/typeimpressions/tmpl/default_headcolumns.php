<?php
defined('_JEXEC') or die('Restricted Access');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

<tr>
    <th width="5%" class="hidden-phone center">
        <?php echo JHtml::_('grid.checkall'); ?>
    </th> 
    <th width="5%" class="nowrap center">
        <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 't.id', $listDirn, $listOrder) ?>
    </th>                  
    <th width="20%" class="nowrap center">
        <?php echo JHtml::_('grid.sort', 'COM_CP3D_TYPE_IMPRESSION_MODELE', 't.idModele', $listDirn, $listOrder) ?>
    </th>
    <th width="20%" class="nowrap center">
        <?php echo JHtml::_('grid.sort', 'COM_CP3D_TYPE_IMPRESSION_MATERIAU', 't.idMateriau', $listDirn, $listOrder) ?>
    </th>
    <th width="10%" class="nowrap hidden-phone center">
        <?php echo JHtml::_('grid.sort', 'COM_CP3D_TYPE_IMPRESSION_PRIXUNITHT', 't.prixUniteHT', $listDirn, $listOrder) ?>
    </th>
    <th width="10%" class="nowrap hidden-phone center">
        <?php echo JHtml::_('grid.sort', 'COM_CP3D_TYPE_IMPRESSION_RETRIBDESIGNER', 't.retribDesignerHT', $listDirn, $listOrder) ?>
    </th>
    <th width="10%" class="nowrap center hidden-phone hidden-tablet">
        <?php echo JHtml::_('grid.sort', 'JPUBLISHED', 't.published', $listDirn, $listOrder) ?>
    </th>
    <th width="10%" class="nowrap center hidden-phone hidden-tablet">
        <?php echo JHtml::_('grid.sort', 'JGLOBAL_HITS', 't.hits', $listDirn, $listOrder) ?>
    </th>
    
</tr>


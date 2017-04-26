<?php
defined('_JEXEC') or die('Restricted Access');

$listOrder= $this->escape($this->state->get('list.ordering'));
$listDirn= $this->escape($this->state->get('list.direction'));
?>

	<tr>
                <th width="5%" class="hidden-phone center">
                        <?php echo JHtml::_('grid.checkall'); ?>
                </th>  
                              
                <th width="25%" class="nowrap center">
                        <?php echo JHtml::_('grid.sort', 'COM_CP3D_ENTREPRISE_RAISONSOCIALE', 'e.raisonSociale', $listDirn, $listOrder) ?>
                </th>
                <th width="25%" class="center">
                        <?php echo JHtml::_('grid.sort', 'COM_CP3D_ENTREPRISE_NUMSIRET', 'e.numSIRET', $listDirn, $listOrder) ?>
                </th>    

                <th width="20%" class="nowrap hidden-phone center">
                        <?php echo JHtml::_('grid.sort', 'COM_CP3D_ENTREPRISE_RIB', 'e.rib', $listDirn, $listOrder) ?>
                </th>
                </th>
                      <th width="15%" class="hidden-phone center">
                        <?php echo JHtml::_('grid.sort', 'COM_CP3D_PUBLISHED', 'e.published', $listDirn, $listOrder) ?>
		        <th width="10%" class="hidden-phone nowrap center">
			         <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'e.id', $listDirn, $listOrder); ?>
		        </th>
	</tr>


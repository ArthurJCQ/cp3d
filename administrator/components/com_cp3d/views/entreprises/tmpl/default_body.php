<?php
defined('_JEXEC') or die('Restricted Access');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

$saveOrder	= $listOrder == 'ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_cp3d&task=entreprises.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
?>

<?php foreach($this->items as $i => $item): ?>
        <tr class="row<?php echo $i % 2; ?>">
                <td width="5%" class="center hidden-phone">
                        <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                </td>
                <td width="25%" class="center">
                        <div class="center">
                                <a href="<?php echo JRoute::_('index.php?option=com_cp3d&task=entreprise.edit&id='.(int) $item->id); ?>">
                                        <?php echo $this->escape($item->raisonSociale); ?>
                                </a>
                        </div>
                </td>
                <td width="25%" class="center">
                        <div class="center">
                                <?php echo $item->numSIRET; ?>
                        </div>
                </td>
                <td width="20%" class="center hidden-phone">
                        <?php echo $item->rib; ?>
                </td>
                <td width="15%" class="center hidden-phone">
                        <?php echo JHtml::_('jgrid.published', $item->published, $i, 'entreprises.', true); ?>
                </td>

                <td width="10%" class="center hidden-phone">
                        <?php echo (int) $item->id; ?>
                </td>
        </tr>
<?php endforeach; ?>

<?php
defined('_JEXEC') or die('Restricted Access');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

$saveOrder	= $listOrder == 'ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_cp3d&task=typeimpressions.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
?>

<?php foreach($this->items as $i => $item): ?>
        <tr class="row<?php echo $i % 2; ?>">
            <td class="center hidden-phone">
                    <?php echo JHtml::_('grid.id', $i, $item->id); ?>
            </td>
            <td class="center">
                <a href="<?php echo JRoute::_('index.php?option=com_cp3d&task=typeimpression.edit&id='.(int) $item->id); ?>">
                        <?php echo $this->escape($item->id); ?>
                </a>
            </td>
            <td  class="center">
                <?php echo $item->modele_nom; ?>
            </td>
            <td  class="center">
                <?php echo $item->materiau_nom; ?>
            </td>
            <td  class="center hidden-phone">
                <?php echo $item->prixUniteHT; ?>
            </td>
            <td  class="center hidden-phone">
                <?php echo $item->retribDesignerHT; ?>
            </td>
            <td  class="center hidden-phone hidden-tablet">
                <?php echo JHtml::_('jgrid.published', $item->published, $i, 'typeimpressions.', true); ?>
            </td>
            <td  class="center hidden-phone hidden-tablet">
                <?php echo $item->hits; ?>
            </td>
        </tr>
<?php endforeach; ?>

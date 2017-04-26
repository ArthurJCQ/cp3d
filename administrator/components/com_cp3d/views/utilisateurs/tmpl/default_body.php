<?php
defined('_JEXEC') or die('Restricted Access');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

$saveOrder	= $listOrder == 'ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_cp3d&task=utilisateurs.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
?>

<?php foreach($this->items as $i => $item): ?>
        <tr class="row<?php echo $i % 2; ?>">
                <td width="5%" class="center hidden-phone">
                        <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                </td>
				<td width="15%" class="wrap has-context center">
					<a href="<?php echo JRoute::_('index.php?option=com_cp3d&task=utilisateur.edit&id='.(int) $item->id); ?>">
						<?php echo $this->escape($item->nom); ?>
					</a>
                </td>
                <td width="15%" class="center wrap has-context">
                    <?php echo $this->escape($item->prenom); ?>
                </td>
                <td width="15%" class="center hidden-phone">
                        <?php echo $item->email; ?>
                </td>
                <td width="15%" class="center hidden-tablet hidden-phone">
                        <?php echo $item->entreprise; ?>
                </td>
                <td width="15%" class="center hidden-tablet hidden-phone">
                        <?php echo $item->pays; ?>
                </td>
				<td width="10%" class="center hidden-phone">
					<?php echo JHtml::_('jgrid.published', $item->published, $i, 'utilisateurs.', true); ?>
				</td>
                <td width="10%" class="center hidden-phone">
                        <?php echo (int) $item->id; ?>
                </td>
        </tr>
<?php endforeach; ?>

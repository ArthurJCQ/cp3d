<?php
defined('_JEXEC') or die('Restricted Access');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

$saveOrder	= $listOrder == 'ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_cp3d&task=commandes.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
?>

<?php foreach($this->items as $i => $item): ?>
	<tr class="row<?= $i % 2; ?>">
		<td class="span1 center hidden-phone">
			<?= JHtml::_('grid.id', $i, $item->cid); ?>
		</td>
		<td class="span1">
			<a href="<?php echo JRoute::_('index.php?option=com_cp3d&task=commande.edit&id='.(int) $item->id); ?>">
						<?php echo $this->escape($item->numCommande); ?>
			</a>
		</td>
		<td class="span3">
			<?= $this->escape($item->etat); ?>
		</td>
		<td class="span2">
			<?= $this->escape($item->prenom); ?>
		</td>
		<td class="span2">
			<?= $this->escape($item->nom); ?>
		</td>
		<td class="span2">
			<?= $this->escape($item->cid); ?>
		</td>
	</tr>
<?php endforeach; ?>
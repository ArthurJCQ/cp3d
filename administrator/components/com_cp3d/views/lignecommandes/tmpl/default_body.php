<?php
defined('_JEXEC') or die('Restricted Access');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

$saveOrder	= $listOrder == 'ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=COM_CP3D&task=entreprises.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
?>

<?php foreach($this->items as $i => $item): ?>
        <tr class="row<?php echo $i % 2; ?>">
			<td class="center">
					<?php echo JHtml::_('grid.id', $i, $item->id); ?>
			</td>
	        <td align="small" class="center">
					<?php echo $item->idCommande; ?>
			</td>
			<td class="center">
				<?php echo $item->quantite; ?>
			</td>
			<td class="center">
				<?php echo $item->dateProduction; ?>
			</td>

			<td class="center">
					<?php echo $item->raisonSociale;?>
			</td>
			
			<td align="small" class="center">
					<?php echo $item->idTypeImpression; ?>
			</td>
			<td align="center">
				<?php echo JHtml::_('jgrid.published', $item->published, $i, 'lignecommandes.', true); ?>
			</td>
			<td class="center">
					<?php echo (int) $item->hits; ?>
			</td>
			<td class="center">
			<a href="<?php echo JRoute::_('index.php?option=com_cp3d&task=lignecommande.edit&id='.(int) $item->id); ?>">
				<?php echo (int) $item->id; ?>
			</a>
			</td>
        </tr>
<?php endforeach; ?>

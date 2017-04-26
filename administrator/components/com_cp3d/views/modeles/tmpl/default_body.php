<?php
defined('_JEXEC') or die('Restricted Access');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

$saveOrder	= $listOrder == 'ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_cp3d&task=modeles.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
?>

<?php foreach($this->items as $i => $item): ?>
	<tr class="row<?php echo $i % 2; ?>">
		<td width="5%" class="center hidden-phone">
				<?php echo JHtml::_('grid.id', $i, $item->id); ?>
		</td>
		<td width="15%" class="nowrap has-context">
			<div class="center">
				<a href="<?php echo JRoute::_('index.php?option=com_cp3d&task=modele.edit&id='.(int) $item->id); ?>">
					<?php echo $this->escape($item->nom); ?>
				</a>
			</div>
		</td>
		<td width="15%" class="nowrap center">
			<?php echo "<img src='" . "../images/cp3d/modeles/" . $item->dossierImage . "/thumbnail.png". "border='0' />"; ?>
		</td>
		<td width="15%" class="center hidden-phone">
            <?php echo $item->nomUtilisateur; ?>
        </td>
        <td width="15%" class="center hidden-phone">
            <?php echo $item->theme; ?>
        </td>
        <td width="15%" class="center hidden-phone">
            <?php echo $item->etatModele; ?>
        </td>
		<td width="15%" class="center hidden-tablet hidden-phone">
			<?php echo JHtml::_('jgrid.published', $item->published, $i, 'modeles.', true); ?>
		</td>
		<td width="5%" class="center hidden-tablet hidden-phone">
			<?php echo (int) $item->id; ?>
		</td>
	</tr>
<?php endforeach; ?>

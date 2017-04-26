<?php
defined('_JEXEC') or die;

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

<form action="<?php echo JUri::getInstance()->toString(); ?>" method="post" name="adminForm" id="adminForm">

	<fieldset class="filters">
		<div class="display-limit">
		</div>
		<input type="hidden" name="filter_order" value="<?php echo $listOrder ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn ?>" />
		<input type="hidden" name="task" value="" />
	</fieldset>
	
	<div class="form-inline form-inline-header">
		<div class="filter-search btn-group pull-left">
			<input type="text" name="filter_search" id="filter_search" placeholder="<?php echo JText::_('JSEARCH_FILTER');?>" 
			value="<?php echo $this->escape($this->state->get('filter.search')); ?>" />
		</div>		
		<div class="btn-group pull-left">
			<button type="submit" class="btn" title="<?php echo JText::_('JSEARCH_FILTER');?>">
				<i class="icon-search"></i></button>
		</div>		
		<div class="btn-group pull-right">
			<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?></label>
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
	</div>			
	<div class="clearfix"> </div>
	<br />
	<table class="table table-striped" id="articleList">
		<thead>
			<tr>
				<th class="center">
		            <?php echo JHtml::_('grid.sort', 'COM_CP3D_LIGNE_COMMANDE_ARTICLE', 'm.nom', $listDirn, $listOrder) ?>
		        </th>	
		        <th class="center">
		            <?php echo JHtml::_('grid.sort', 'COM_CP3D_LIGNE_COMMANDE_QUANTITE', 'lc.quantite', $listDirn, $listOrder) ?>
		        </th>		        
		        <th class="center">
		            <?php echo JHtml::_('grid.sort', 'COM_CP3D_LIGNE_COMMANDE_DATE_PROD', 'lc.dateProduction', $listDirn, $listOrder) ?>
		        </th>
		        <th class="center">
		            <?php echo JHtml::_('grid.sort', 'COM_CP3D_LIGNE_COMMANDE_ENTREPRISE', 'e.raisonSociale', $listDirn, $listOrder) ?>
		        </th>
		        <th class="center">
		            <?php echo JHtml::_('grid.sort', 'COM_CP3D_LIGNE_COMMANDE_COMMENTAIRE', 'lc.commentaire', $listDirn, $listOrder) ?>
		        </th>        
		    </tr>
		</thead>

		<tbody>
			<?php foreach($this->items as $i => $item): ?>
		        <tr class="row<?php echo $i % 2; ?>">
		        	<td class="center">
						<?php echo $item->nom; ?>
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
					<td class="center">
						<?php echo $item->commentaire;?>
					</td>
		        </tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</form>

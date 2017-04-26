<?php
defined('_JEXEC') or die;

$uriCompoDetail = JURI::base(true)."/index.php?option=com_cp3d&view=modele&id=";

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

<form action="<?php echo JUri::getInstance()->toString(); ?>" method="post" name="adminForm" id="adminForm">
 		
	<!-- affichage du filtre de nombre d'enregistrement par page -->
	<fieldset class="filters">
		<div class="display-limit">
			<?php // echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
			<?php // echo $this->pagination->getLimitBox(); ?>
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
		<!-- Ajouter un modèle -->
		<!--
		<div class="btn-group pull-left">
			<a href="<?php echo JRoute::_('index.php?option=com_cp3d&view=form_m&layout=edit'); ?>" class="btn" role="button"><span class="icon-plus"></span></a>
		</div>	
		-->
		<div class="btn-group pull-right">
			<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?></label>
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
	</div>			
	<div class="clearfix"> </div>
	<br />
	<!-- Mosaique -->
	<?php foreach($this->items as $i => $item) : ?>
		<div class="span3">
			<div class="thumbnail">
				<a href="<?php echo $uriCompoDetail.$item->id ?>">
					<center>
					<img src="images/cp3d/modeles/<?php echo  $item->alias; ?>/thumbnail.png" width="50%" height="50%" class="img-responsive img-rounded">
					</center>
				</a>
				<div class="caption text-center">
						<h3><a href="<?php echo $uriCompoDetail.$item->id ?>"><?php echo $item->nom ?></a></h3>
						<p><?php echo $item->description ?></p>
						<i><?php echo $item->theme ?></i>
				</div>
			</div>
		</div>			
	<?php endforeach; ?>
	<!-- Fin mosaique -->
	
</form>

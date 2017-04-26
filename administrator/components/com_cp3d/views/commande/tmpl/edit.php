<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'commande.cancel' || document.formvalidator.isValid(document.id('cp3d-form')))
		{
			<?php //echo $this->form->getField('activite')->save();
				  //echo $this->form->getField('commentaire')->save(); ?>
			Joomla.submitform(task, document.getElementById('cp3d-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_cp3d&view=commande&layout=edit&id='.(int) $this->item->id); ?>"
      method="post" name="adminForm" id="cp3d-form" class="form-validate">
	<div class="form-inline form-inline-header">
		<div class="control-group">
			<div class="control-label"><?php echo $this->form->getLabel('numCommande'); ?></div>
			<div class="controls"><?php echo $this->form->getInput('numCommande'); ?></div>
		</div>								
	</div>	
	
	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('COM_CP3D_COMMANDE')); ?>
		<br>
		<div class="row-fluid">
			<div class="span6">
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('idUtilisateur'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('idUtilisateur'); ?></div>
				</div>				
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('dateCommande'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('dateCommande'); ?></div>
				</div>	
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('prixTotalHT'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('prixTotalHT'); ?></div>
				</div>	
			</div>
			<div class="span6">
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('prixTotalTTC'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('prixTotalTTC'); ?></div>
				</div>	
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('tva'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('tva'); ?></div>
				</div>	
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('idEtatCommande'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('idEtatCommande'); ?></div>
				</div>	
			</div>
		</div>

		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'infos', JText::_('COM_CP3D_ADVANCED')); ?>

		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'publishing', JText::_('JGLOBAL_FIELDSET_PUBLISHING', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('joomla.edit.publishingdata', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('joomla.edit.metadata', $this); ?>
			</div>
		</div>
	
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JLayoutHelper::render('joomla.edit.params', $this); ?>

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>
	</div>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>

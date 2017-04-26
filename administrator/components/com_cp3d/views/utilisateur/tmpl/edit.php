<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'utilisateur.cancel' || document.formvalidator.isValid(document.id('cp3d-form')))
		{
			<!-- <?php // echo $this->form->getField('nom')->save(); ?> -->
			Joomla.submitform(task, document.getElementById('cp3d-form'));
		}
	}
</script> 

<form action="<?php echo JRoute::_('index.php?option=com_cp3d&view=utilisateur&layout=edit&id='.(int) $this->item->id); ?>"
      method="post" name="adminForm" id="cp3d-form" class="form-validate">

	<div class="form-inline form-inline-header">
		<div class="control-group">
			<?php echo $this->form->getControlGroup('nom'); ?>
		</div>				
		<div class="control-group">
			<?php echo $this->form->getControlGroup('prenom'); ?>
		</div>
		<div class="control-group">
			<?php echo $this->form->getControlGroup('alias'); ?>
		</div>					
	</div>	
      				
	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('COM_CP3D_UTILISATEUR')); ?>

		<br>
		<div class="row-fluid">
			<div class="span6">
				<div class="control-group">
					<?php echo $this->form->getControlGroup('email'); ?>
				</div>	
				<div class="control-group">
					<?php echo $this->form->getControlGroup('dateNaissance'); ?>
				</div>	
			</div>
			<div class="span6">
				<div class="control-group">
					<?php echo $this->form->getControlGroup('adr_rue'); ?>
				</div>	
				<div class="control-group">
					<?php echo $this->form->getControlGroup('adr_ville'); ?>
				</div>	
				<div class="control-group">
					<?php echo $this->form->getControlGroup('adr_CP'); ?>
				</div>	
				<div class="control-group">
					<?php echo $this->form->getControlGroup('idPays'); ?>
				</div>	
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'infos', JText::_('COM_CP3D_ADVANCED')); ?>
			<div class="control-group">
				<?php echo $this->form->getControlGroup('idEntreprise'); ?>
			</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>


		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'publishing', JText::_('JGLOBAL_FIELDSET_PUBLISHING', true)); ?>
		<div class="span3">
			<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
		</div>
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

<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'entreprise.cancel' || document.formvalidator.isValid(document.id('cp3d-form')))
		{
			<?php echo $this->form->getField('activite')->save();
					echo $this->form->getField('commentaire')->save(); ?>
			Joomla.submitform(task, document.getElementById('cp3d-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_cp3d&view=entreprise&layout=edit&id='.(int) $this->item->id); ?>"
      method="post" name="adminForm" id="cp3d-form" class="form-validate">
				
<div class="form-inline form-inline-header">
		<div class="control-group">
			<div class="control-label"><?php echo $this->form->getLabel('raisonSociale'); ?></div>
			<div class="controls"><?php echo $this->form->getInput('raisonSociale'); ?></div>
		</div>					
		<div class="control-group">
			<div class="control-label"><?php echo $this->form->getLabel('alias'); ?></div>
			<div class="controls"><?php echo $this->form->getInput('alias'); ?></div>
		</div>					
	</div>
	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('COM_CP3D_ENTREPRISE')); ?>
		
		<div class="control-group">
			<div class="control-label"><?php echo $this->form->getLabel('rib'); ?></div>
			<div class="controls"><?php echo $this->form->getInput('rib'); ?></div>
		</div>		
		<div class="control-group">
			<div class="control-label"><?php echo $this->form->getLabel('numSIRET'); ?></div>
			<div class="controls"><?php echo $this->form->getInput('numSIRET'); ?></div>
		</div>	
		
		<div class="row-fluid">
			<div class="span9">
				<?php echo $this->form->getControlGroup('logo'); ?>
			</div>

			<div class="span3">
				<?php echo "<img src='" . "../" . $this->item->logo . "' border='0' />"; ?>
			</div>
		</div>
		<br>
		
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'infos', JText::_('COM_CP3D_ADVANCED')); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="row-fluid">
				<div class="form-vertical">
					<?php echo $this->form->getControlGroup('activite'); ?>
				</div>
		</div>
		<div class="row-fluid">
				<div class="form-vertical">
					<?php echo $this->form->getControlGroup('commentaire'); ?>
				</div>
		</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'publishing', JText::_('JGLOBAL_FIELDSET_PUBLISHING', true)); ?>
		<div class="row-fluid">
			<div class="span3">
				<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
			</div>
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

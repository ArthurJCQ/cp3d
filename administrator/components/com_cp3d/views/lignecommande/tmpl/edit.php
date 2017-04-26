<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'ligneCommande.cancel' || document.formvalidator.isValid(document.id('cp3d-form')))
		{
			<?php echo $this->form->getField('commentaire')->save(); ?>

			Joomla.submitform(task, document.getElementById('cp3d-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=COM_CP3D&layout=edit&id='.(int) $this->item->id); ?>"
      method="post" name="adminForm" id="cp3d-form" class="form-validate">

	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('quantite'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('quantite'); ?></div>
	</div>				

	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('numCommande'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('numCommande'); ?></div>
	</div>				
	

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'infos', JText::_('COM_CP3D_LIGNE_COMMANDE')); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="form-vertical">
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('note'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('note'); ?></div> </br>
					<div class="control-label"><?php echo $this->form->getLabel('dateProduction'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('dateProduction'); ?></div> </br>
					<div class="control-label"><?php echo $this->form->getLabel('dateAvis'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('dateAvis'); ?></div> </br>				
					<div class="control-label"><?php echo $this->form->getLabel('idTypeImpression'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('idTypeImpression'); ?></div> </br>
					<div class="control-label"><?php echo $this->form->getLabel('idEntreprise'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('idEntreprise'); ?></div> </br>

				</div>					
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('COM_CP3D_ADVANCED')); ?>
		<div class="row-fluid">
			<div class="span9">
				<div class="form-vertical ">
					<div class="control-label"><?php echo $this->form->getLabel('activite'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('activite'); ?></div>
				</div>
			</div>
			<div class="span9">
				<div class="form-vertical">
					<?php echo $this->form->getControlGroup('commentaire'); ?>
				</div>
			</div>
			<div class="span3">
				<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
			</div>
		</div>
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

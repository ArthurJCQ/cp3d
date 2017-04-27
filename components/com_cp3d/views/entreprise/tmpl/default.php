<?php
defined('_JEXEC') or die('Restricted access');

$user = JFactory::getUser();               		// gets current user object
$isDirecteur = (in_array('11', $user->groups));		// sets flag when user group is '10' that is 'MRH Administrateur 
?>

<?php if (!$isDirecteur) : ?>
	<?php echo JError::raiseWarning( 100, JText::_('COM_CP3D_RESTRICTED_ACCESS') ); ?>
<?php else : ?>
	<div class="form-inline form-inline-header">
		<div class="btn-group pull-left">
			<h2><?php echo JText::_('COM_CP3D_ENTREPRISE'); ?></h2>
		</div>
		<div class="btn-group pull-right">
			<a href="<?php echo JRoute::_('index.php?option=com_cp3d&view=entreprises'); ?>" class="btn" role="button">
				<span class="icon-cancel"></span></a>
		</div>	
		<div class="btn-group pull-right">
			<a href="<?php echo JRoute::_('index.php?option=com_cp3d&view=form&layout=edit&id='.$this->item->id); ?>" class="btn" role="button">
				<span class="icon-edit"></span></a>
		</div>	
	</div>	
	<div>
		<table class="table">
			<tbody>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_CP3D_ENTREPRISES_RAISON_SOCIALE'); ?></span>
					</td>
					<td width="80%">
						<h4><?php echo $this->item->raisonSociale ?></h4>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_CP3D_ENTREPRISES_ALIAS'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->alias ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_CP3D_ENTREPRISES_NUM_SIRET'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->numSIRET ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_CP3D_ENTREPRISES_RIB'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->rib ?>
					</td>
				</tr>
				<tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_CP3D_ENTREPRISES_PUBLISHED'); ?></span>
					</td>
					<td width="80%">
							<?php echo $this->item->published; ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_CP3D_ENTREPRISES_NUM_SIRET'); ?></span>
					</td>
					<td width="80%">
							<?php echo $this->item->numSIRET; ?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
<?php endif; ?>

<?php
defined('_JEXEC') or die('Restricted access');

$user = JFactory::getUser();               		// gets current user object
$isDirector = (in_array('11', $user->groups));		// sets flag when user group is '11' that is CP3D-Director
$isDesigner = (in_array('13', $user->groups));
$isCP3D = (in_array('16', $user->groups));		// sets flag when user group is '16' that is CP3D
?>

<?php if (!$isCP3D) : ?>
	<?php echo JError::raiseWarning( 100, JText::_('COM_CP3D_RESTRICTED_ACCESS') ); ?>
<?php else : ?>
	<div class="form-inline form-inline-header">
		<div class="btn-group pull-left">
			<h2><?php echo JText::_('COM_CP3D_UTILISATEURS'); ?></h2>
		</div>
		<div class="btn-group pull-right">
			<a href="<?php echo JRoute::_('index.php?option=com_cp3d&view=utilisateurs'); ?>" class="btn" role="button">
				<span class="icon-cancel"></span></a>
		</div>	
		<div class="btn-group pull-right">
			<a href="<?php echo JRoute::_('index.php?option=com_cp3d&view=form_m&layout=edit&id='.$this->item->id); ?>" class="btn" role="button">
				<span class="icon-edit"></span></a>
		</div>
	</div>	
	<div>
		<table class="table">
			<tbody>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_CP3D_UTILISATEUR_NOM'); ?></span>
					</td>
					<td width="80%">
						<h4><?php echo $this->item->nom ?></h4>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_CP3D_UTILISATEUR_PRENOM'); ?></span>
					</td>
					<td width="80%">
						<h4><?php echo $this->item->prenom ?></h4>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_CP3D_UTILISATEUR_EMAIL'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->email ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_CP3D_UTILISATEUR_ENTREPRISE'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->raisonSociale ?>
					</td>
				</tr>
					<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_CP3D_UTILISATEUR_ALIAS'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->alias ?>
					</td>
					</tr>

					<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_CP3D_UTILISATEUR_ADR_RUE'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->adr_rue ?>
					</td>
					</tr>

					<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_CP3D_UTILISATEUR_ADR_VILLE'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->adr_ville ?>
					</td>
					</tr>

					<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_CP3D_UTILISATEUR_ADR_CP'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->adr_CP ?>
					</td>
					</tr>

					<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_CP3D_UTILISATEUR_DATENAISSANCE'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->dateNaissance ?>
					</td>
					</tr>

					<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_CP3D_UTILISATEUR_ADR_PAYS'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->pays ?>
					</td>
					</tr>

				</tr>
			</tbody>
		</table>
	</div>
<?php endif; ?>

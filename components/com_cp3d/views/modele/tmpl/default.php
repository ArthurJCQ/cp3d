<?php
defined('_JEXEC') or die('Restricted access');

$user = JFactory::getUser();               		// gets current user object
$isCp3d = (in_array('16', $user->groups));		// sets flag when user group is '16' that is 'CP3D'
$isDesigner = (in_array('13', $user->groups));	// sets flag when user group is '13' that is 'CP3D-Designer'
$isImprimeur = (in_array('15', $user->groups));	// sets flag when user group is '15' that is 'CP3D-Imprimeur'
?>

<?php if (!$isCp3d xor $isImprimeur xor $isDesigner) : ?>
	<?php echo JError::raiseWarning( 100, JText::_('COM_CP3D_RESTRICTED_ACCESS') ); ?>
<?php else : ?>
	<div class="row-fluid">
		<div class="form-inline form-inline-header">
			<div class="btn-group pull-left">
				<h2><?php echo JText::_('COM_CP3D_MODELE')." : "; ?> <span><?php echo $this->item->nom ?></span></h2> 
			</div>
			<div class="btn-group pull-right">
				<a href="<?php echo JRoute::_('index.php?option=com_cp3d&view=modeles'); ?>" class="btn" role="button">
					<span class="icon-cancel"></span></a>
			</div>	
			<!-- Editer -->
			<?php if ($isDesigner) : ?>
				<div class="btn-group pull-right">
					<a href="<?php echo JRoute::_('index.php?option=com_cp3d&view=form_m&layout=edit&id='.$this->item->id); ?>" class="btn" role="button">
						<span class="icon-edit"></span></a>
				</div>
			<?php endif; ?>
		</div>
	</div>	<hr>
	<div class="clearfix"> </div>
	<div class="row-fluid">
		<div class="span4">
			<center>
				<div class="row-fluid">
					<img src="images/cp3d/modeles/<?php echo  $this->item->alias; ?>/thumbnail.png" width="50%" height="50%" class="img-responsive img-rounded">
				</div>
				<div class="row-fluid">
					<select> 
					<?php
					$this->types= $this->get('Types');
					foreach ($this->types as $t) {
						echo "<option>".$t->materiau." - ".$t->prixUniteHT."€ </option>";
					}
					?>
					</select>
				</div>
				<div class="row-fluid">
					<a class="btn btn-success" href=""> Commander </a>
				</div>
			</center>
		</div> <br>
		<div class="span8">
			<table class="table">
				<tbody>
					<tr>
						<td width="20%" class="nowrap right">
							<span class="label"><?php echo JText::_('COM_CP3D_MODELE_NOM'); ?></span>
						</td>
						<td width="80%">
							<?php echo $this->item->nom ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="nowrap right">
							<span class="label"><?php echo JText::_('COM_CP3D_MODELE_DESCRIPTION'); ?></span>
						</td>
						<td width="80%">
							<?php echo $this->item->description ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="nowrap right">
							<span class="label"><?php echo JText::_('COM_CP3D_MODELE_ETAT'); ?></span>
						</td>
						<td width="80%">
							<?php echo $this->item->etatModele?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="nowrap right">
							<span class="label"><?php echo JText::_('COM_CP3D_MODELE_THEME'); ?></span>
						</td>
						<td width="80%">
							<?php echo $this->item->theme ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="nowrap right">
							<span class="label"><?php echo JText::_('COM_CP3D_MODELE_DESIGNER'); ?></span>
						</td>
						<td width="80%">
							<?php echo $this->item->nomU ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="nowrap right">
							<span class="label"><?php echo JText::_('JGLOBAL_HITS'); ?></span>
						</td>
						<td width="80%">
							<?php echo $this->item->hits ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>	
	</div>
<?php endif; ?>

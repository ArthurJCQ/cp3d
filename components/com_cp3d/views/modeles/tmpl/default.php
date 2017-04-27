<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.framework'); 				// javascript Joomla object for grid.sort !

$user = JFactory::getUser();               		// gets current user object
$isCp3d = (in_array('16', $user->groups));		// sets flag when user group is '16' that is 'CP3D
$isDesigner = (in_array('13', $user->groups));	// sets flag when user group is '13' that is 'CP3D-Designer'
$isImprimeur = (in_array('15', $user->groups));	// sets flag when user group is '15' that is 'CP3D-Imprimeur'

?>

<?php if (!$isCp3d xor $isImprimeur xor $isDesigner) : ?>
	<?php echo JError::raiseWarning( 100, JText::_('COM_CP3D_RESTRICTED_ACCESS') ); ?>
<?php else : ?>

	<h2><?php echo JText::_('COM_CP3D_OPTIONS')." : ".JText::_('COM_CP3D_MODELES'); ?>
	</h2>
	<div class="row-fluid center">
		<?php echo $this->loadTemplate('items'); ?>
	</div>
	<div class="row-fluid center">
		<?php echo $this->pagination->getListFooter(); ?>
	</div>
<?php endif; ?>

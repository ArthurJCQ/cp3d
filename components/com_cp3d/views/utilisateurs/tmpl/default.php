<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.framework'); 				// javascript Joomla object for grid.sort !

$user = JFactory::getUser();               		// gets current user object
$isCP3D = (in_array('16', $user->groups));		// sets flag when user group is '16' that is CP3D
?>

<?php if (!$isCP3D) : ?>
	<?php echo JError::raiseWarning( 100, JText::_('COM_CP3D_RESTRICTED_ACCESS') ); ?>
<?php else : ?>

	<h2><?php echo JText::_('COM_CP3D_OPTIONS')." : ".JText::_('COM_CP3D_UTILISATEURS'); ?>
	</h2>
	<div class="row-fluid center">
		<?php echo $this->loadTemplate('items'); ?>
	</div>
	<div class="row-fluid center">
		<?php echo $this->pagination->getListFooter(); ?>
	</div>
<?php endif; ?>

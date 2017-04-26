<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.framework'); 				// javascript Joomla object for grid.sort !

$user = JFactory::getUser();               		// gets current user object
$isAdmin = (in_array('11', $user->groups));		// sets flag when user group is '10' that is 'MRH Administrateur 
$isCP3D = (in_array('17', $user->groups));		// sets flag when user group is '10' that is 'MRH Administrateur 

?>

<?php if (!$isCP3D) : ?>
	<?php echo JError::raiseWarning( 100, JText::_('COM_CP3D_RESTRICTED_ACCESS') ); ?>
<?php else : ?>

	<h2><?php echo JText::_('COM_CP3D_OPTIONS')." : ".JText::_('COM_CP3D_UTILISATEURS')." - "; ?>
		<a href="<?php echo JRoute::_('index.php?option=com_cp3d&view=entreprises'); ?>">
			<?php echo JText::_('COM_CP3D_ENTREPRISES'); ?>
		</a>
	</h2>

	<?php echo $this->loadTemplate('items'); ?>

	<?php echo $this->pagination->getListFooter(); ?>

<?php endif; ?>

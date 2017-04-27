<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.framework'); 				// javascript Joomla object for grid.sort !

$user = JFactory::getUser();               		// gets current user object
$idCurrentUser = $user->id;
$idCurrentGroup = 0;				
//Gestion des groupes
if (in_array('14', $user->groups)) { $idCurrentGroup = 1; } //1 = CLIENT
else if (in_array('15', $user->groups)) { $idCurrentGroup = 2; } //2 = IMPRIMEUR 
else if (in_array('11', $user->groups)) { $idCurrentGroup = 3; } //3 = DIRECTEUR
?>

<?php if ($idCurrentGroup == 0) : ?>
	<?php echo JError::raiseWarning( 100, JText::_('COM_CP3D_RESTRICTED_ACCESS') ); ?>
<?php else : ?>

	<h2><?php echo JText::_('COM_CP3D_OPTIONS')." : ".JText::_('COM_CP3D_ENTREPRISE')." - "; ?>
		<a href="<?php echo JRoute::_('index.php?option=com_cp3d&view=commandes'); ?>">
			<?php echo JText::_('COM_CP3D_COMMANDE'); ?>
		</a>
	</h2>

	<?php echo $this->loadTemplate('items'); ?>

	<?php echo $this->pagination->getListFooter(); ?>

<?php endif; ?>

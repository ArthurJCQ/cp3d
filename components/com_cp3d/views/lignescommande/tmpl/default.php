<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.framework');

$user = JFactory::getUser();

/**
 * @author n0dai <n0dai@hotmail.com>
 *
 * Ici se trouve la vérification des permissions d'accès
 * à la page affichant les lignes d'une commande.
 *
 * Le groupe portant l'id 11 est le groupe du directeur CP3D
 *
 * A changer à l'intégration en fonction du groupe du directeur
 */
$isAdmin = (in_array('11', $user->groups));
?>

<?php if (!$isAdmin) : ?>
	<?php echo JError::raiseWarning( 100, JText::_('COM_CP3D_RESTRICTED_ACCESS') ); ?>
<?php else : ?>

	<h2><?php echo JText::_('COM_CP3D_OPTIONS')." : ".JText::_('COM_CP3D_LIGNES_COMMANDE'); ?></h2>

	<?php echo $this->loadTemplate('items'); ?>

	<?php echo $this->pagination->getListFooter(); ?>

<?php endif; ?>

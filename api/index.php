<?php
/**
 * @copyright  Copyright (C) 2016 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

define('JOOMLA_MINIMUM_PHP', '5.3.10');

if (version_compare(PHP_VERSION, JOOMLA_MINIMUM_PHP, '<'))
{
	die('Your host needs to use PHP ' . JOOMLA_MINIMUM_PHP . ' or higher to run this version of Joomla!');
}

// Sauve l'heure courante et la quantité de mémoire utilisée par PHP :
$startTime = microtime(1);
$startMem  = memory_get_usage();

define('_JEXEC', 1);

if (file_exists(__DIR__ . '/defines.php'))
{
	include_once __DIR__ . '/defines.php';
}

if (!defined('_JDEFINES'))
{
	define('JPATH_BASE', __DIR__);
	require_once JPATH_BASE . '/includes/defines.php';
}

// Chargement du Framework Joomla :
require_once JPATH_BASE . '/includes/framework.php';

// Définit dans le profiler l'heure de début et la mémoire utilisée et la marque afterLoad :
JDEBUG ? $_PROFILER->setStart($startTime, $startMem)->mark('afterLoad') : null;

// Chargement de l'application :
require_once JPATH_BASE . '/application/cp3d.php';
$app = JApplicationWeb::getInstance('AppCP3DWeb');
JFactory::$application = $app;
$app->doExecute();


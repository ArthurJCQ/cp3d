<?php
/**
 * @copyright  Copyright (C) 2016 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Redéfinit le séparateur de dossiers
const DS = DIRECTORY_SEPARATOR;
// Enregistre les dossiers du chemin courant dans un tableau
$parts = explode(DS, JPATH_BASE);
// Dépile le dernier élément du tableau
array_pop($parts);

// Definit les constantes JPATH_
define('JPATH_ROOT',          implode(DS, $parts));
define('JPATH_API',           JPATH_BASE);
define('JPATH_SITE',          JPATH_BASE);
define('JPATH_CONFIGURATION', JPATH_ROOT);
define('JPATH_ADMINISTRATOR', JPATH_ROOT . DS . 'administrator');
define('JPATH_LIBRARIES',     JPATH_ROOT . DS . 'libraries');
define('JPATH_PLUGINS',       JPATH_ROOT . DS . 'plugins');
define('JPATH_INSTALLATION',  JPATH_ROOT . DS . 'installation');
define('JPATH_THEMES',        JPATH_BASE . DS . 'templates');
define('JPATH_CACHE',         JPATH_BASE . DS . 'cache');
define('JPATH_MANIFESTS',     JPATH_ADMINISTRATOR . DS . 'manifests');

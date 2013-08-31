<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$app 	  = JFactory::getApplication();	
$document =& JFactory::getDocument();
$template = $app->getTemplate();

// Include Camera Slideshow styles
switch($params->get('theme')){
	case 0:
		$document->addStyleSheet(JURI::base() . 'modules/mod_camera_slideshow/css/camera.css');
		break;
	case 1:
		$document->addStyleSheet(JURI::base() . 'templates/'.$template.'/css/camera.css');
		break;
}

// Include Camera Slideshow scripts
switch($params->get('script')){
	case 0:
		$document->addScript(JURI::base() . 'modules/mod_camera_slideshow/js/camera.min.js');
		break;
	case 1:
		$document->addScript(JURI::base() . 'modules/mod_camera_slideshow/js/camera.js');
		break;	
	case 2:
		$document->addScript(JURI::base() . 'templates/'.$template.'/js/camera.js');
		break;
}

$document->addScript(JURI::base() . 'modules/mod_camera_slideshow/js/jquery.mobile.customized.min.js');

$list = modCameraSlideshowHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_camera_slideshow', $params->get('layout', 'default'));

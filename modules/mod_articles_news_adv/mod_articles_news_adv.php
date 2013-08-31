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

$menu = JMenu::getInstance('site');

$list = modArticlesNewsHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$columns = (int)$params->get('columns');
$bootstrap_layout = $params->get('bootstrap_layout');

switch ($bootstrap_layout) {
  case 0:
    $row_class = 'row';
    break;
  case 1:
    $row_class = 'row-fluid';
    break;  
  default:
    $row_class = 'row';
    break;
}

require JModuleHelper::getLayoutPath('mod_articles_news_adv', $params->get('layout', 'default'));

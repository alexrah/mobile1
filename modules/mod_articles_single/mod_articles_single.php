<?php

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';
$menu = JMenu::getInstance('site');

$item = modArticlesSingleHelper::getItem($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$item_heading = $params->get('item_heading', 'h4');
$item_images = json_decode($item->images);

require JModuleHelper::getLayoutPath('mod_articles_single', $params->get('layout', 'default'));

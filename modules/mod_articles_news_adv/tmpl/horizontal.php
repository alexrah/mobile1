<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

  $n = count($list);

  if($columns == 0){
    $span_num = floor($params->get('bootstrap_size')/$n);
  } else {
    $span_num = $columns;
  }
  $rows = ceil($n/$span_num);
?>

<div class="mod-newsflash-adv mod-newsflash-adv__<?php echo $moduleclass_sfx; ?>">

  <?php if ($params->get('pretext')): ?>
    <div class="pretext">
      <?php echo $params->get('pretext') ?>
    </div>
  <?php endif; ?>  
    
  <?php if($columns !== 1): ?>
    <div class="<?php echo $row_class; ?>">
  <?php endif; ?>
  
    <?php for ($i = 0, $n; $i < $n; $i ++) :
      $item = $list[$i]; 

      $class="";
      if($i == $n-1){
        $class="lastItem";
      }

      if($rows > 1 && $columns > 1 && $i !== 0 && $i % $columns == 0){
        echo '</div><div class="'. $row_class .'">';
      };
    ?>

      <div class="itemSpan<?php echo $span_num; ?> item item_num<?php echo $i; ?> item__module  <?php echo $class; ?>">
        <?php require JModuleHelper::getLayoutPath('mod_articles_news_adv', '_item'); ?>
      </div>
    <?php endfor; ?>
  <?php if($columns !== 1): ?>
    </div> 
  <?php endif; ?>

  <div class="clearfix"></div>

  <?php if($params->get('mod_button') == 1): ?>   
    <div class="mod-newsflash-adv_custom-link">
      <?php 
        $menuLink = $menu->getItem($params->get('custom_link_menu'));

          switch ($params->get('custom_link_route')) 
          {
            case 0:
              $link_url = $params->get('custom_link_url');
              break;
            case 1:
              $link_url = JRoute::_($menuLink->link.'&Itemid='.$menuLink->id);
              break;            
            default:
              $link_url = "#";
              break;
          }
          echo '<a class="btn btn-info" href="'. $link_url .'">'. $params->get('custom_link_title') .'</a>';
      ?>
    </div>
  <?php endif; ?>
</div>

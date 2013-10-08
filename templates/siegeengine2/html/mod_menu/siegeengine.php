<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
// Note. It is important to remove spaces between elements.

?>
<?php // The menu class is deprecated. Use nav instead. ?>
<nav class="top-bar">
 <ul class="title-area">
    <!-- Title Area -->

    <li class="right language"><a href="#"><span>Ita/Eng</span></a></li>
   <!-- AddThis Follow BEGIN -->
<div class="right language addthis_toolbox addthis_default_style" style="margin-top:9px;">
<a class="addthis_button_facebook_follow" addthis:url="https://www.facebook.com/pages/COTE/140940539252548"></a>
<a class="addthis_button_twitter_follow" addthis:userid="cote_italia"></a>
<a class="addthis_button_instagram_follow" addthis:userid="cote_official"></a>
<a class="addthis_button_pinterest_follow" addthis:userid="coteofficial"></a>
<a class="addthis_button_tumblr_follow" addthis:userid="cote-official"></a>

</div>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52317c2c571a9a95"></script>
<!-- AddThis Follow END -->
 
    </li>
			    <!-- <li class="name">\
 -->
    <!-- \
 -->
    <!--   <h1><a href="#"></a></h1>\
 -->
    <!-- </li>\
 -->

    <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar homemenu"><a href="#"><span>Menu</span></a></li>

  </ul>

   <ul class="top-bar-section">

 <li class="title-area right language-wide language-text"><a href="#"><span>Ita/Eng</span></a></li>

   <!-- AddThis Follow BEGIN -->
<div class="right language-wide addthis_toolbox addthis_default_style" style="margin-top:6px; margin-right: -10px; height: 45px;">
<!-- <a class="addthis_button_facebook_follow" addthis:userid="YOUR-PROFILE"></a> -->
<a class="addthis_button_facebook_follow" addthis:url="https://www.facebook.com/pages/COTE/140940539252548"></a>
<a class="addthis_button_twitter_follow" addthis:userid="cote_italia"></a>
<a class="addthis_button_instagram_follow" addthis:userid="cote_official"></a>
<a class="addthis_button_pinterest_follow" addthis:userid="coteofficial"></a>
<a class="addthis_button_tumblr_follow" addthis:userid="cote-official"></a>
</div>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52317c2c571a9a95"></script>
<!-- AddThis Follow END -->


</ul>
<section class="top-bar-section">
    <!-- Left Nav Section -->
    <ul class="left <?php echo $class_sfx;?>"<?php
        $tag = '';
        if ($params->get('tag_id') != null)
        {
            $tag = $params->get('tag_id').'';
            echo ' id="'.$tag.'"';
        }
    ?>>
    <?php
    foreach ($list as $i => &$item) :
        $class = 'item-'.$item->id;
        if ($item->id == $active_id) {
            $class .= ' current';
        }
    
        if (in_array($item->id, $path)) {
            $class .= ' active';
        }
        elseif ($item->type == 'alias') {
            $aliasToId = $item->params->get('aliasoptions');
            if (count($path) > 0 && $aliasToId == $path[count($path) - 1]) {
                $class .= ' active';
            }
            elseif (in_array($aliasToId, $path)) {
                $class .= ' alias-parent-active';
            }
        }
        if ($item->deeper) {
            $class .= 'deeper has-dropdown';
        }
        if ($item->deeper) {
            $class .= ' deeper';
        }
    
        if ($item->parent) {
            $class .= ' parent';
        }
    
        if (!empty($class)) {
            $class = ' class="'.trim($class) .'"';
        }
    
        echo '<li'.$class.'>';
    
        // Render the menu item.
        switch ($item->type) :
            case 'separator':
            case 'url':
            case 'component':
                require JModuleHelper::getLayoutPath('mod_menu', 'default_'.$item->type);
                break;
    
            default:
                require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
                break;
        endswitch;
      
        // The next item is deeper.
        if ($item->deeper) {
            echo '<ul class="dropdown">';
        }
        // The next item is shallower.
        elseif ($item->shallower) {
            echo '</li>';
            echo str_repeat('</ul></li>', $item->level_diff);
        }
        // The next item is on the same level.
        else {
            echo '</li>';
        }
    endforeach;
    ?></ul>
      </section>
</nav>

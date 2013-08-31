<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_camera_slideshow
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$images = json_decode($item->images);
?>

<div class="camera-item" data-src="<?php echo htmlspecialchars($images->image_fulltext); ?>" data-thumb="<?php echo htmlspecialchars($images->image_intro); ?>">

	<?php if ($params->get('show_caption') == '1'): ?>
		<div class="camera_caption <?php echo $params->get('captionEffect'); ?>">
			<?php $item_heading = $params->get('item_heading', 'h4'); ?>
			<?php if ($params->get('item_title')) : ?>
	
				<<?php echo $item_heading; ?> class="slide-title<?php echo $params->get('moduleclass_sfx'); ?>">
				<?php if ($params->get('link_titles') && $item->link != '') : ?>
					<a href="<?php echo $item->link;?>">
						<?php echo $item->title;?></a>
				<?php else : ?>
					<?php echo $item->title; ?>
				<?php endif; ?>
				</<?php echo $item_heading; ?>>
	
			<?php endif; ?>
	
			<?php if (!$params->get('intro_only')) :
				echo $item->afterDisplayTitle;
			endif; ?>
	
			<?php echo $item->beforeDisplayContent; ?>
	
			
			<?php echo $item->introtext; ?>
	
		<!-- Read More link -->
		<?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) :
			$readMoreText = JText::_('TPL_COM_CONTENT_READ_MORE');
				if ($item->alternative_readmore){
					$readMoreText = $item->alternative_readmore;
				}
			echo '<a class="btn btn-info readmore" href="'.$item->link.'"><span>'. $readMoreText .'</span></a>';
		endif; ?>

		</div>
	<?php endif; ?>

</div>

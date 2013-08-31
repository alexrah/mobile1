<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Create a shortcut for params.
$params = &$this->item->params;
$images = json_decode($this->item->images);
$canEdit	= $this->item->params->get('access-edit');
$info    = $this->item->params->get('info_block_position', 0);
?>
<?php if ($this->item->state == 0) : ?>
<div class="system-unpublished">
<?php endif; ?>
<article>
	<?php if ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>
		<?php endif; ?>

	<?php  if (isset($images->image_intro) and !empty($images->image_intro)) : ?>
	<?php $imgfloat = (empty($images->float_intro)) ? $params->get('float_intro') : $images->float_intro; ?>
		<figure class="img-<?php echo htmlspecialchars($imgfloat); ?>">
			<img title="<?php echo htmlspecialchars($images->image_intro_caption); ?>" src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/>
				<?php if ($images->image_intro_caption): ?>
					<figcaption><?php echo htmlspecialchars($images->image_intro_caption); ?></figcaption>
				<?php endif; ?>
		</figure>
	<?php endif; ?>

	<?php if ($params->get('show_title')) : ?>
	<header>
		<h1>
		</h1>
	</header>
	<?php endif; ?>
	<?php if ($this->item->state == 0): ?>
		<div class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></div>
	<?php endif; ?>

	<?php if (!$params->get('show_intro')) : ?>
		<?php echo $this->item->event->afterDisplayTitle; ?>
	<?php endif; ?>
		<?php echo $this->item->event->beforeDisplayContent; ?>

	<div class="article-body">
		<?php echo $this->item->introtext; ?>
		<?php if ($params->get('show_readmore') && $this->item->readmore) :
		if ($params->get('access-view')) :
			$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
		else :
			$menu = JFactory::getApplication()->getMenu();
			$active = $menu->getActive();
			$itemId = $active->id;
			$link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
			$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
			$link = new JURI($link1);
			$link->setVar('return', base64_encode($returnURL));
		endif;
		?>
			<a class="readmore" href="<?php echo $link; ?>">
			<?php if (!$params->get('access-view')) :
					echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
				elseif ($readmore = $this->item->alternative_readmore) :
					echo $readmore;
					if ($params->get('show_readmore_title', 0) != 0) :
						echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
					endif;
				elseif ($params->get('show_readmore_title', 0) == 0) :
					echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
				else :
					echo JText::_('COM_CONTENT_READ_MORE');
					echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
				endif; ?>
			</a>
		<?php endif; ?>
	<div>
</article>
<?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>
<?php echo $this->item->event->afterDisplayContent; ?>

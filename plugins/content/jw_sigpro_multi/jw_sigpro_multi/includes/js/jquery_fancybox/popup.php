<?php
/**
 * @version		$Id: popup.php 2829 2013-04-12 14:20:40Z joomlaworks $
 * @package		Simple Image Gallery Pro
 * @author		JoomlaWorks - http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2013 JoomlaWorks Ltd. All rights reserved.
 * @license		http://www.joomlaworks.net/license
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$relName = 'fancybox-button';
$extraClass = 'fancybox-button';

$stylesheets = array(
	'fancybox/jquery.fancybox.css?v=2.1.4',
	'fancybox/helpers/jquery.fancybox-buttons.css?v=2.1.4',
	'fancybox/helpers/jquery.fancybox-thumbs.css?v=2.1.4'
);
$stylesheetDeclarations = array();
$scripts = array(
	'fancybox/lib/jquery.mousewheel-3.0.6.pack.js',
	'fancybox/jquery.fancybox.pack.js?v=2.1.4',
	'fancybox/helpers/jquery.fancybox-buttons.js?v=2.1.4',
	'fancybox/helpers/jquery.fancybox-thumbs.js?v=2.1.4'
);

if(!defined('PE_FANCYBOX_LOADED')){
	define('PE_FANCYBOX_LOADED', true);
	$scriptDeclarations = array('
		jQuery.noConflict();
		jQuery(function($) {
			$("a.fancybox-button").fancybox({
				//padding: 0,
				//fitToView	: false,
				helpers		: {
					title	: { type : \'over\' }, // options: over, inside, outside, float
					buttons	: {}
				},
				afterLoad : function() {
					this.title = \'<b class="fancyboxCounter">Image \' + (this.index + 1) + \' of \' + this.group.length + \'</b>\' + (this.title ? this.title : \'\');
				}
			});
		});
	');
} else {
	$scriptDeclarations = array();
}


<?php defined('JPATH_BASE') or die('Restricted access');

// Program: Fox Contact for Joomla
// Copyright (C): 2011 Demis Palma
// Documentation: http://www.fox.ra.it/forum/2-documentation.html
// License: Distributed under the terms of the GNU General Public License GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html

jimport('joomla.html.html');
jimport('joomla.form.formfield');

class JFormFieldFConditionalWarningLabel extends JFormField
	{
	protected $type = 'FConditionalWarningLabel';

	protected function getInput()
		{
		return '';
		}

	protected function getLabel()
		{
/*
		(include_once JPATH_ROOT . "/components/com_foxcontact/helpers/flogger.php") or die(JText::sprintf("JLIB_FILESYSTEM_ERROR_READ_UNABLE_TO_OPEN_FILE", "flogger.php"));
		$log = new FLogger($this->type, "debug");
		$log->Write($this->element["name"] . " getLabel()");
*/
		$cn = basename(realpath(dirname(__FILE__) . '/../..'));

		$direction = intval(JFactory::getLanguage()->get('rtl', 0));
		$left  = $direction ? "right" : "left";
		$right = $direction ? "left" : "right";

		$db = JFactory::getDBO();
		$sql = "SELECT value FROM #__" . substr($cn, 4) . "_settings WHERE name = '" . $this->element['triggerkey'] . "';";
		$db->setQuery($sql);
		$method = $db->loadResult();

		if (!$method)
			{
			// Database error. Example: table missing. $method = NULL, $db->_errornum = 1146, $db->_errormsg = table doesn't exist
			// Record missing. $method = NULL, $db->_errornum = 0, $db->_errormsg = ""
			// $db->getErrorNum()
			// $db->getErrorMsg()
			$style = 'clear:both; background:#f4f4f4; border:1px solid silver; padding:5px; margin:5px 0;';
			$image = '<img style="margin:0; float:' . $left . ';" src="' . JUri::base() . '../media/' . $cn . '/images/exclamation-16.png">';
			return
				'<div style="' . $style . '">' .
				$image .
				'<span style="padding-' . $left . ':5px; line-height:16px;">' .
				JText::_(strtoupper($cn) . '_ERR_DATABASE_PROBLEMS') .
				' <a href="http://www.fox.ra.it/forum/15-installation/1579-error-message-qproblems-with-databaseq.html" target="_blank">' .
				JText::_(strtoupper($cn) . '_DOCUMENTATION') .
				'</a>.' .
				'</span>' .
				'</div>';
			}

		if (/*$method &&*/ $method != $this->element['triggervalue'])
			{
			return "";
			}

		echo '<div class="clr"></div>';
		$image = '';
		$icon	= (string)$this->element['icon'];
		if (!empty($icon))
			{
			$image .= '<img style="margin:0; float:' . $left . ';" src="' . JUri::base() . '../media/' . $cn . '/images/' . $icon . '">';
			}

		$style = 'background:#f4f4f4; border:1px solid silver; padding:5px; margin:5px 0;';
		if ($this->element['default'])
			{
			return '<div style="' . $style . '">' .
				$image .
				'<span style="padding-' . $left . ':5px; line-height:16px;">' .
				JText::_($this->element['default']) .
				'. <a href="' . $this->element['triggerdata'] . '" target="_blank">' .
				JText::_(strtoupper($cn) . '_DOCUMENTATION') .
				'</a>.' .
				'</span>' .
				'</div>';
			}
		else
			{
			return parent::getLabel();
			}

		echo '<div class="clr"></div>';
		}
	}
?>

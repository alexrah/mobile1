<?php defined('_JEXEC') or die('Restricted access');

// Program: Fox Contact for Joomla
// Copyright (C): 2011 Demis Palma
// Documentation: http://www.fox.ra.it/forum/2-documentation.html
// License: Distributed under the terms of the GNU General Public License GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html

$inc_dir = realpath(dirname(__FILE__));
require_once($inc_dir . '/fdatapump.php');
require_once($inc_dir . '/flogger.php');
jimport('joomla.mail.helper');
defined("DEFAULT_CHECKBOXMAP") or define("DEFAULT_CHECKBOXMAP", "hidden|hidden");

class FNewsletter extends FDataPump
{
	const master = 0;
	const lists = 1;

	protected $FieldsBuilder;
	protected $lists;
	protected $logger;
	protected $enabled;
	protected $prefix;


	public function __construct(&$params, FoxMessageBoard &$messageboard, &$fieldsbuilder)
	{
		parent::__construct($params, $messageboard);

		$this->FieldsBuilder = $fieldsbuilder;

		$this->logger = new FLogger();

		$this->load_newsletter_config();
		$this->load_newsletter_lists();
	}


	protected function LoadFields()
	{
	}


	public function Show()
	{
		// Newsletter component disabled or not found. Aborting.
		if (!$this->enabled) return "";
		$result = "";

		// Some friendly aliases
		$post = isset($_POST[$this->GetId()]);
		// Checkboxes selected by user or hidden and enabled fields
		$values = $this->JInput->post->get($this->prefix . "_subscribe", array(), "array");
		// Checkbox drawing behaviour
		$checkbox_map = explode("|", $this->Params->get($this->prefix . "_checkboxes", DEFAULT_CHECKBOXMAP));
		// Parameter automatically check the checkboxes
		$autocheck = $this->Params->get($this->prefix . "_auto_checked", 0);

		// Draw the cumulative field
		$field = array();

		// Standard attributes
		$field["value"] = 1;
		$field["caption"] = JText::_('COM_FOXCONTACT_ALL_NEWSLETTERS');
		$field["PostName"] = $this->prefix . "_subscribe_cumulative";

		// checked status
		$value = $this->JInput->post->get($this->prefix . "_subscribe_cumulative", NULL, "int");
		$field["checked"] = $post && $value || !$post && $autocheck;

		// "visible" attribute
		$field["visible"] = $checkbox_map[FNewsletter::master];

		// Draw the global field
		$result .= $this->{$field["visible"]}($field);

		// Draw each field
		foreach ($this->lists as $list)
		{
			$field = array();

			// Standard attributes
			$field["value"] = $list["id"];
			$field["caption"] = $list["name"];
			$field["PostName"] = $this->prefix . "_subscribe[" . $list["id"] . "]";

			// checked status
			$value = @$values[$list["id"]];
			$field["checked"] = $post && $value || !$post && $autocheck;

			// "visible" attribute
			$field["visible"] = $list["visible"] ? $checkbox_map[FNewsletter::lists] : "hidden";

			// Draw the field
			$result .= $this->{$field["visible"]}($field);
		}

		// Display checkboxes
		return $result;
	}


	public function Process()
	{
		// Disabled in form configuration. Aborting.
		if (!$this->enabled) return true;

		// Trig the contact plugins to integrate with other applications
		$contact = new stdClass(); // We can't fill this data, but plugins may expect this parameter to be a valid object
		$data = array();
		$data["contact_name"] = isset($this->FieldsBuilder->Fields['sender0']) ? $this->FieldsBuilder->Fields['sender0']['Value'] : "";
		$data["contact_email"] = empty($this->FieldsBuilder->Fields['sender1']['Value']) ? NULL : JMailHelper::cleanAddress($this->FieldsBuilder->Fields['sender1']['Value']);
		$data["contact_subject"] = $this->Params->get("email_subject", "");
		$data["contact_message"] = isset($this->FieldsBuilder->Fields['textarea0']) ? $this->FieldsBuilder->Fields['textarea0']['Value'] : "";
		JPluginHelper::importPlugin("contact");
		JDispatcher::getInstance()->trigger("onSubmitContact", array(&$contact, &$data));
		return true;
	}


	protected function load_newsletter_config()
	{
		return $this->enabled = (int)$this->Params->get("othernewsletters", 1);
	}


	protected function load_newsletter_lists()
	{
		$this->lists = array();
	}


	protected function extension_exists($extension)
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select($db->quoteName("extension_id"));
		$query->from($db->quoteName("#__extensions"));
		$query->where($db->quoteName("name") . " = " . $db->quote($extension));
		$db->setQuery($query);
		return (bool)$db->loadResult();
	}


	protected function checkbox($field)
	{
		// Fixes che "checked" value suitable for html output
		$field["checked"] = (bool)$field["checked"] ? 'checked=""' : "";

		$this->CreateSpacerLabel();

		$result =
			'<div class="control-group">' .
				$this->LabelHtmlCode .
				'<div class="controls">' .
				'<label class="checkbox">' .
				'<input ' .
				'type="checkbox" ' .
				'value="' . $field["value"] . '" ' .
				$field["checked"] . " " .
				'name="' . $field['PostName'] . '" ' .
				'id="c' . $field['PostName'] . '" ' .
				'/>' .
				JText::_('COM_FOXCONTACT_SUBSCRIBE_TO') . " " . $field['caption'] .
				'</label>' .
				'</div>' . // controls
				'</div>' . PHP_EOL; // control-group

		return $result;
	}


	protected function hidden($field)
	{
		$result =
			'<input ' .
				'type="hidden" ' .
				'value="' . $field["value"] . '" ' .
				'name="' . $field['PostName'] . '" ' .
				'/>' . PHP_EOL;

		return $result;
	}


	protected function label($field)
	{
		$this->CreateSpacerLabel();

		$result =
			$this->hidden($field) .
				'<div class="control-group">' .
				$this->LabelHtmlCode .
				'<div class="controls">' .
				'<label class="checkbox">' .
				'<i>' .
				$field["caption"] .
				'</i>' .
				'</label>' .
				'</div>' . // controls
				'</div>' . PHP_EOL; // control-group

		return $result;
	}

}

